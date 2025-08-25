<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if (auth()->guest()) {
            Alert::error('Please Login First!');
            return redirect('/login');
        }

        $stayfrom = Carbon::parse($request->from);
        $stayuntil = Carbon::parse($request->to);

        $room = Room::findOrFail($request->room);

        // Cek ketersediaan kamar
        $cektransaksi = Transaction::where('room_id', $request->room)
            ->where(function ($query) use ($stayfrom, $stayuntil) {
                $query->where('check_in', '<', $stayuntil)
                    ->where('check_out', '>', $stayfrom);
            })
            ->exists();

        if ($cektransaksi) {
            Alert::error('Kamar Tidak Tersedia');
            return back();
        }

        // Cek customer
        if ($request->customer == null) {
            $auth = Auth()->user()->Customer->id;
            $customer = Customer::findOrFail($auth);
        } else {
            $customer = Customer::findOrFail($request->customer);
        }

        $price = $room->price;
        $dayDifference = $stayfrom->diffInDays($stayuntil);
        $total = $price * $dayDifference;

        $paymentmethodnotid = [1];
        $paymentmet = PaymentMethod::whereNotIn('id', $paymentmethodnotid)->get();

        return view('frontend.order', compact(
            'customer',
            'room',
            'stayfrom',
            'dayDifference',
            'stayuntil',
            'total',
            'paymentmet'
        ));
    }

    public function order(Request $request)
    {
        $rooms = Room::where('id', $request->room)->first();
        $customers = Customer::where('id', $request->customer)->first();

        //cek transaksi apakah kamar sudah ada booking
        $stayfrom = Carbon::parse($request->check_in);
        $stayuntil = Carbon::parse($request->check_out);
        $cektransaksi = Transaction::where('room_id', $request->room)
            ->where(function ($query) use ($stayfrom, $stayuntil) {
                $query->where('check_in', '<', $stayuntil)
                    ->where('check_out', '>', $stayfrom);
            })
            ->exists();
        if ($cektransaksi) {
            Alert::error('Kamar Tidak Tersedia');
            return back();
        }


        if ($customers->nik == null) {
            Alert::error('Kesalahan Data', 'Mohon Isi Data NIK');
            return redirect('myaccount');
        }

        $transaction = $this->storetransaction($request, $rooms);
        $status = 'Pending';
        $payment = $this->storepayment($request, $transaction, $status);

        $superAdmins = User::where('is_admin', 1)->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $customers->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }
        event(new RefreshDashboardEvent("Someone reserved a room"));
        $inv = Payment::where('c_id', $request->customer)->orderby('id', 'desc')->first();
        Alert::success('Thanks!', 'Room ' . $rooms->no . ' Has been reservated' . ' Please Pay now!');
        return redirect('/bayar/' . $inv->Transaction->id);
    }

    public function invoice($id)
    {
        $p = Payment::where('id', $id)->with('Customer', 'Transaction', 'Methode')->first();
        if ($p->status == 'Pending') {
            return abort(404);
        }
        // dd($p);
        return view('frontend.invoice', compact('p'));
    }

    public function pembayaran($id)
    {

        $t = Transaction::findOrFail($id);

        $pay = DB::table('payments')
                ->where('transaction_id', $id)
                ->first();

        $user = Auth::user();

        $price = Room::where('id', $t->Room->id)->first()->price;

          // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

         // Cek status transaksi jika token sudah ada
        if ($pay->image) {
            try {
                $status = (object) \Midtrans\Transaction::status($pay->invoice);
                if ($status->transaction_status === 'expire') {
                    // Buat Snap Token baru karena token lama sudah expired
                    $pay->image = null;
                    $pay->status = 'expired';
                    $pay->save();
                }
            } catch (\Exception $e) {
                // Token lama tidak valid, reset saja
                $pay->image = null;
                $pay->save();
            }
        }

        if (!$pay->image) {
            $params = [
                'transaction_details' => [
                    'order_id' => $pay->invoice,
                    'gross_amount' => (int) $pay->price,
                ],
                'customer_details' => [
                    'first_name' => $user->username,
                    'email' => $user->email,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            DB::table('payments')
                ->where('transaction_id', $id)
                ->update([
                    'image' => $snapToken,
                    'status' => 'Pending'
                ]);

        } else {
            $snapToken = $pay->image;
        }

        return view('frontend.bayar', compact('t', 'price', 'pay', 'snapToken'));
    }

    public function bayar(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|file',
        ]);
        if ($request->file('image')) {
            $image = $validatedData['image'] = $request->file('image')->store('bukti-images', 'public');
        }
        $payment = Payment::findOrFail($request->id);
        // dd($request->all());
        $payment->update([
            'image' => $image,
        ]);
        Alert::success('Pembayaran Berhasil', 'Tunggu Konfirmasi!');
        return redirect('/history');
    }

    private function storetransaction($request, $rooms)
    {
        // dd($request->customer);
        $storetransaction = Transaction::create([
            // 'user_id' => auth()->user()->id,
            'room_id' => $rooms->id,
            'c_id' => $request->customer,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);
        return $storetransaction;
    }

    private function storepayment($request, $transaction, string $status)
    {
        $price = $request->price;
        $count = Payment::count() + 1;
        $payment = Payment::create([
            'c_id' => $request->customer,
            'transaction_id' => $transaction->id,
            'price' => $price,
            'status' => $status,
            'invoice' =>  '0' . $request->customer . 'INV' . $count . Str::random(4)
        ]);

        return $payment;
    }
}

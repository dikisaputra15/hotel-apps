@extends('frontend.inc.main')
@section('title')
    <title>Lippo Carita | FORM BUKTI PEMBAYARAN</title>
@endsection

@push('style')
    <script type="text/javascript"
		src="{{config('midtrans.snap_url')}}"
    data-client-key="{{config('midtrans.client_key')}}"></script>
@endpush

@section('content')
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-6 mb-4 mb-lg-0 mb-md-0">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="row">
                            <h4>Detail Pesanan <span>#{{ $pay->invoice }}</span></h4>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row mb-3">
                                    <label for="room_number" class="col-sm-2 col-form-label">Room</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"z id="room_no" name="room_no"
                                            placeholder="col-form-label" value="{{ $t->room->no }} " disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="room_type" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_type" name="room_type"
                                            placeholder="col-form-label" value="{{ $t->room->type->name }} " disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="room_capacity" class="col-sm-2 col-form-label">Capacity</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_capacity" name="room_capacity"
                                            placeholder="col-form-label" value="{{ $t->room->capacity }} " disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="room_price" class="col-sm-2 col-form-label">Price / Day</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_price" name="room_price"
                                            placeholder="col-form-label" value="IDR {{ number_format($t->room->price) }}"
                                            disabled>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="col-sm-12 mt-2">

                                <div class="row mb-3">
                                    <label for="check_in" class="col-sm-2 col-form-label">Check In</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" id="check_in" name="check_in"
                                            placeholder="col-form-label"
                                            value="{{ Carbon\Carbon::parse($t->check_in)->isoformat('D MMMM Y') }}"
                                            disabled>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="check_out" class="col-sm-2 col-form-label">Check Out</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="check_out" name="check_out"
                                            placeholder="col-form-label"
                                            value="{{ Carbon\Carbon::parse($t->check_out)->isoformat('D MMMM Y') }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="how_long" class="col-sm-2 col-form-label">Total Day</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="how_long" name="how_long"
                                            placeholder="col-form-label"
                                            value="{{ $t->check_in->diffindays($t->check_out) }} Day" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="total_price" name="total_price"
                                            placeholder="col-form-label" value="IDR {{ number_format($price) }} " disabled>
                                    </div>
                                </div>

                                <button id="pay-button" class="btn btn-sm w-100 btn-danger shadow-none mb-2">Bayar Sekarang</button>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
            },
            onPending: function(result) {
                alert("sedang menunggu pembayaran.");
                console.log(result);
            },
            onError: function(result) {
                alert("Terjadi kesalahan saat pembayaran.");
                console.log(result);
            }
        });
    });
</script>
@endpush

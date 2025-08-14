@extends('frontend.inc.main')
@section('title')
    <title>
        Lippo Carita | HISTORY PEMESANAN</title>
@endsection

@section('content')
    <div class="container " style="margin-top:30px;margin-bottom:310px">
        <div class="row">
            {{-- <table class="table"> --}}
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body text-center">

                        @if ($user->image)
                            <img alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;"src="{{ asset('storage/' . $user->image) }}">
                        @else
                            <img alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;"src="/img/default-user.jpg">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <table>
                                    <tr>
                                        <td>
                                            <h5> History Pemesanan </h5>
                                            <h3> {{ $user->Customer->name }}</h3>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-7 col-md-12 px-4">
                @foreach ($his as $h)
                    <div class="card mb-4 border-0 shadow">
                        <div class="d-flex g-0 p-3 justify-content-between">

                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-1">#{{ $loop->iteration }} {{ $h->invoice }}</h5>
                                <div class="guests">
                                    <h5 class="mb-1"></h5>

                                </div>
                                <div class="features mb-3 mt-3">
                                    <h6 class="mb-1">Status @if ($h->status == 'Pending' and $h->image != null)
                                            <span style="color:red">{{ $h->status }}</span> | Sudah Bayar
                                        @elseif ($h->status == 'Pending' and $h->image == null)
                                            <span style="color:red">{{ $h->status }}</span>
                                        @else
                                            <span style="color:green">{{ $h->status }}</span>
                                        @endif
                                    </h6>
                                    <h6 class="mb-1">Total IDR {{ number_format($h->price) }}</h6>

                                </div>


                            </div>
                            <div class="col-md-3 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h6 class="mb-4 text-dark"> {{ $h->created_at }} </h6>
                                @if ($h->status == 'Pending' and $h->image == null)
                                    <a class="btn btn-sm w-100 btn-danger shadow-none mb-2"
                                        href="/bayar/{{ $h->transaction_id }}">Bayar Sekarang</a>
                                    <a class="btn btn-sm w-100 btn-secondary shadow-none"
                                        style="pointer-events: none;
                        cursor: default;"
                                        href="/invoice/{{ $h->id }}">Lihat Invoice</a>
                                @elseif ($h->status == 'Pending' and $h->image != null)
                                    <a class="btn btn-sm w-100 btn-danger shadow-none mb-2"
                                        href="/bayar/{{ $h->id }}"
                                        style="pointer-events: none;
                            cursor: default;">Tunggu
                                        Konfirmasi</a>
                                    <a class="btn btn-sm w-100 btn-secondary shadow-none"
                                        style="pointer-events: none;
                        cursor: default;"
                                        href="/invoice/{{ $h->id }}">Lihat Invoice</a>
                                @else
                                    <a class="btn btn-sm w-100 btn-dark shadow-none"
                                        href="/invoice/{{ $h->id }}">Lihat Invoice</a>
                                @endif


                                {{-- <a href="/rooms/" class="btn btn-sm w-100 btn-dark shadow-none">More details</a> --}}

                            </div>
                        </div>

                    </div>
                @endforeach
                {!! $his->links() !!}
            </div>


        </div>
    </div>
@endsection

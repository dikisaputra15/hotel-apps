@extends('frontend.inc.main')
@section('title')
    <title>Lippo Carita | Cari Kamar</title>
@endsection

@section('content')
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <p class="h5 mt-3 text-center">{{ $roomsCount }} Rooms Availlable</p>
        <div class="h-line bg-dark"></div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-0">

                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <form action="/rooms" method="GET">
                                @csrf
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                    <label class="form-label">Check-in</label>
                                    <input type="date" name="from" class="form-control shadow-none mb-3" min="{{ date('Y-m-d') }}">
                                    <label class="form-label">Check-out</label>
                                    <input type="date" name="to" class="form-control shadow-none" min="{{ date('Y-m-d') }}">
                                </div>
                                {{-- <div class="border bg-light p-3 rounded mb-3">
        <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
        <div class="mb-2">
          <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
          <label class="form-check-label" for="f1">Facility one</label>
        </div>
        <div class="mb-2">
            <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
          <label class="form-check-label" for="f2">Facility two</label>
        </div>
        <div class="mb-2">
          <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
          <label class="form-check-label" for="f3">Facility three</label>
        </div>
    </div> --}}
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">Person</h5>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <label class="form-label">How many person?</label>
                                            <input type="number" name="count" class="form-control shadow-none"
                                                value="1">
                                        </div>
                                        {{-- <div>
          <label class="form-label">Children</label>
          <input type="number" class="form-control shadow-none">
        </div> --}}
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <button class="btn border" type="submit">SEARCH</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </nav>
            </div>


            <div class="col-lg-9 col-md-12 px-4">
                @foreach ($rooms as $r)
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                @if ($r->images->count() > 0)
                                    <img src="{{ asset('storage/' . $r->images[0]->image) }}"
                                        style="max-height:170px; object-fit:cover; width:100%;" class="img-fluid rounded">
                                @else
                                    <img src="/img/kamar 1.jpg" style="max-height:150px; object-fit:cover; width:100%;"
                                        class="img-fluid rounded">
                                @endif
                            </div>

                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-3">{{ $r->type->name }} #{{ $r->no }} </h5>
                                <div class="guests">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        {{ $r->capacity }}
                                    </span>
                                </div>
                                <div class="features mb-3 mt-3">
                                    <h6 class="mb-1">Features</h6>
                                    @if ($r->capacity <= 5)
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 Rooms
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            1 Bathroom
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            1 Balcony
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 Sofa
                                        </span>
                                </div>

                                <div class="Facilities mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Wifi
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Television
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        AC
                                    </span>
                                @elseif ($r->capacity <= 10)
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        3 Rooms
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        2 Bathroom
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        2 Balcony
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        4 Sofa
                                    </span>
                                </div>
                                <div class="Facilities mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Wifi
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Television
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        AC
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Room Heater
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        4 Rooms
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        2 Bathroom
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        2 Balcony
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        6 Sofa
                                    </span>

                                </div>
                                <div class="Facilities mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Wifi
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Television
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        AC
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Room Heater
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Smooking Room
                                    </span>
                @endif
            </div>


        </div>
        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
            <h6 class="mb-4 text-success"> IDR {{ number_format($r->price) }} </h6>
            @if ($request->from)
                <form action="/order" method="post">
                    @csrf
                    <input type="hidden" name="room" value="{{ $r->id }}">
                    <input type="hidden" name="from" value="{{ $request->from }}">
                    <input type="hidden" name="to" value="{{ $request->to }}">
                    <button class="btn btn-sm w-100 btn-light border border-dark shadow-none mb-2">Book now</button>
                </form>
                <form action="/rooms/{{ $r->no }}" method="post">
                    @csrf
                    <input type="hidden" name="no" value="{{ $r->no }}">
                    <input type="hidden" name="from" value="{{ $request->from }}">
                    <input type="hidden" name="to" value="{{ $request->to }}">
                    <button class="btn btn-sm w-100 btn-dark shadow-none">More details</button>
                </form>
            @else
                <a href="/rooms/{{ $r->no }}"
                    class="btn btn-sm w-100 btn-light border border-dark shadow-none mb-2">Book Now</a>
                <a href="/rooms/{{ $r->no }}" class="btn btn-sm w-100 btn-dark shadow-none">More details</a>
            @endif
        </div>
    </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {!! $rooms->links() !!}
    </div>
    </div>


    </div>
    </div>
@endsection

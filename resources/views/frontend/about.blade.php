@extends('frontend.inc.main')
@section('title') <title>Lippo Carita | TENTANG KAMI</title> @endsection

@section('content')

<div class="container mt-5 mb-5" style="margin-bottom:100px">
    <div class="row d-flex justify-content-center">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="/nyoba/images/about/hotel.svg" width="70px">
        <h4 class="mt-3">{{$r }}+ ROOMS</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="/nyoba/images/about/customers.svg" width="70px">
        <h4 class="mt-3">{{$c}}+ CUSTOMERS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="/nyoba/images/about/t.png" width="70px">
            <h4 class="mt-3">{{ $t }}+ TRANSACTIONS</h4>
        </div>
    </div>

</div>
</div>


<div class="container mt-5 mb-5" style="margin-bottom:100px">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 justify order-lg-1 order-md-1 order-2 text-center mt-4 mt-lg-0 mt-md-0">
        <h3 class="mb-3 ">About us</h3>
        <p>
         Selamat datang di Lippo Carita, destinasi sempurna untuk menikmati keindahan Pantai Carita, Banten. Berlokasi tepat di tepi pantai, hotel kami menawarkan pengalaman menginap yang nyaman dengan pemandangan laut yang menakjubkan, suara ombak yang menenangkan, dan udara segar yang menyejukkan. Dengan desain yang memadukan nuansa modern dan sentuhan tropis, kami menyediakan berbagai pilihan kamar yang dilengkapi fasilitas terbaik untuk memastikan kenyamanan Anda. Mulai dari kamar dengan balkon pribadi menghadap laut, kolam renang outdoor yang memanjakan, hingga restoran yang menyajikan hidangan laut segar khas Banten. Kami berkomitmen untuk memberikan pelayanan ramah, suasana hangat, dan pengalaman tak terlupakan bagi setiap tamu. Baik Anda datang untuk liburan keluarga, bulan madu romantis, atau perjalanan bisnis, Lippo Carita adalah pilihan tepat untuk menjadikan momen Anda lebih istimewa.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="/nyoba/images/carousel/1.png" class="w-100 d-block">
        <img src="/nyoba/images/carousel/2.png" class="w-100 d-block">
        <img src="/nyoba/images/carousel/3.png" class="w-100 d-block">
      </div>
    </div>
  </div>


@endsection

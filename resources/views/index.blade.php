@extends('frontend.inc.main')
@section('title') <title>Lippo Carita</title>@endsection

@section('content')
<section class="swiper-image-content">
@include('frontend.sectionindex.swiper')
</section>

 <!-- check avilability form-->
 <section class="form" id="form">
    @include('frontend.sectionindex.form')
 </section>

 <!-- Rooms -->
 <section class="kamar-index py-5" id="kamar-index">
    @include('frontend.sectionindex.kamar')
 </section>

 <!--  Facilities-->
 <section class="facility-index py-5 bg-custom" id="facility-index">
   @include('frontend.sectionindex.facility')
 </section>

 <!-- Contact -->
 <section class="contact-index py-5" id="contact-index">
    @include('frontend.sectionindex.contact')
 </section>
@endsection




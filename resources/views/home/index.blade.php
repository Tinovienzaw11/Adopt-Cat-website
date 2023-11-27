@extends('layouts.home.v_main_home')

@section('css')

@endsection

@section('content')
  <!-- start home section -->
  <section class="section align-items-center bg-home-7 position-relative bg-light" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-7 order-lg-1 order-2">
          <img src="{{ asset('home_assets/images/hero-image-2.png') }}" alt="" class="img-fluid w-full">
        </div>
        <div class="col-lg-6 order-lg-2 order-1">
          <div class="text-left my-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <h6 class="mb-0" style="font-size: 20px;">- Sigmund Fraud</h6>
                  {{--<h1 class="f-80">Sigmund Fraud</h1>--}}
                  <p style="font-size: 16px;">Time spent with cats is never wasted.</p>
                </div>
                <div class="carousel-item">
                  <h6 class="mb-0" style="font-size: 20px;">- Nafisa Joseph</h6>
                  {{--<h1 class="f-80">Idea</h1>--}}
                  <p style="font-size: 16px;">I used to love dogs until I discovered cats.
                </div>
                <div class="carousel-item">
                  <h6 class="mb-0" style="font-size: 20px;">- Edgar Allan Poe</h6>
                  {{--<h1 class="f-80">LANDING</h1>--}}
                  <p style="font-size: 16px;">I wish that my writing was as mysterious as a cat.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </section>
  <!-- end section -->
  
  <!-- start blog -->
  <section class="section bg-light" id="blog">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="text-center">
            <h6 class="text-muted fw-normal">Kucing lucu untuk kamu</h6>
            <h2 class="mb-3">Jadikan rumahmu <span class="text-primary fw-normal">surga </span>baru untuk mereka</h2>
            <p class="text-muted para-p mx-auto mb-0"> kucing adalah teman bermain yang paling menyenangkan dan setia.</p>
          </div>
        </div>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form class="subscribe-form mt-4" action="#">
            <div class="input-group justify-content-center">
              <form action="{{ url()->current() }}" method="get">
                <input type="text" class="form-control" id="search" name="search" value="{{ request()->search ?? '' }}" placeholder="Nama Kucing / Jenis Kucing">
                <button class="btn btn-primary" type="submit" id="btn-cari">Cari Kucing</button>
              </form>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-5">
        @foreach($cats as $cat)
        <div class="col-lg-4 col-md-6 mt-4 mt-3">
          <div class="blog-image overflow-hidden">
            <img src="{{ Storage::url($cat->image) }}" alt="" class="img-fluid w-100" style="height:336px">
          </div>
          <div class="blog-content mb-2">
           <div class="row">
             <div class="col-md-6 col-6">
               <a href="javascript:void(0)">
                 <h6 class="mt-4 mb-2 text-uppercase f-14">{{ $cat->type->name }}</h6>
               </a>
             </div>
             <div class="col-md-6 col-6">
               <a href="javascript:void(0)" class="float-float">
                 <h6 class="mt-4 mb-2 text-uppercase f-14"
                     style="text-align-last: end; color: @if($cat->status == 'waiting') #FFC93C @elseif($cat->status == 'off') #2E302A @else #3AB7CB @endif">
                   @if($cat->status == 'off')
                     Close Adopt
                   @elseif($cat->status == 'waiting')
                     Menunggu Adopter
                   @else
                     Adopted
                   @endif
                 </h6>
               </a>
             </div>
           </div>
            <a href="javascript:void(0)">
              <h4>{{ $cat->name }}</h4>
            </a>
          </div>
          <div class="d-flex mb-3">
            <div class="d-flex align-items-center text-muted">
              <i class="mdi mdi-account-outline f-22 "></i>
              <p class="mb-0 ms-2">{{ $cat->user->name }}</p>
            </div>
            <div class="d-flex align-items-center text-muted ms-4">
              <i class="mdi mdi-calendar-blank f-22 "></i>
              <p class="mb-0 ms-2" data-toggle="tooltip" data-placement="top" title="{{ \Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}">
                {{ \Carbon\Carbon::parse($cat->created_at)->format('d-m-Y H:i') }}
              </p>
            </div>
          </div>
          @if($cat->status == 'waiting')
            <div class="blog-link text-center">
              <a href="https://wa.me/{{ $cat->user->phone_number }}?text=Halo, Saya ingin mengapdopsi kucing Anda!" target="_blank" class="fw-bold f-14">Adopsi Sekarang <i class="mdi mdi-heart align-middle"></i></a>
            </div>
          @endif
        </div>
        @endforeach
      </div>
      <div class="mt-4">
        {{ $cats->links() }}
      </div>
    </div>
  </section>
  <!-- end blog -->
@endsection

@section('js')

@endsection
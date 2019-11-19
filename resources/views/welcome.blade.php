@extends('layouts/app')



<style>

.search-sec{
    padding: 2rem;
}
.search-slt{
    display: block;
    width: 100%;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
.wrn-btn{
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    text-transform: capitalize;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
@media (min-width: 992px){
    .search-sec{
        position: relative;
        top: -114px;
        background: rgba(26, 70, 104, 0.51);
    }
}

@media (max-width: 992px){
    .search-sec{
        background: #1A4668;
    }
}


.product_view .modal-dialog{max-width: 1050px; width: 65%;}
        .pre-cost{text-decoration: line-through; color: #a5a5a5;}
        .space-ten{padding: 10px 0;}

        *,
*::before,
*::after {
  box-sizing: border-box;
}

img {
  display: block;
}

.gallery {
  position: relative;
  z-index: 2;
  padding: 10px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-flow: row wrap;
      flex-flow: row wrap;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  -webkit-transition: all .5s ease-in-out;
  transition: all .5s ease-in-out;
}
.gallery.pop {
  -webkit-filter: blur(10px);
          filter: blur(10px);
}
.gallery figure {
  -ms-flex-preferred-size: 33.333%;
      flex-basis: 33.333%;
  padding: 10px;
  overflow: hidden;
  border-radius: 10px;
  cursor: pointer;
}
.gallery figure img {
  width: 100%;
  border-radius: 10px;
  -webkit-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
}
.gallery figure figcaption {
  display: none;
}

.popup {
  position: fixed;
  z-index: 2;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.75);
  opacity: 0;
  -webkit-transition: opacity .5s ease-in-out .2s;
  transition: opacity .5s ease-in-out .2s;
}
.popup.pop {
  opacity: 1;
  -webkit-transition: opacity .2s ease-in-out 0s;
  transition: opacity .2s ease-in-out 0s;
}
.popup.pop figure {
  margin-top: 0;
  opacity: 1;
}
.popup figure {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  -webkit-transform-origin: 0 0;
          transform-origin: 0 0;
  margin-top: 30px;
  opacity: 0;
  -webkit-animation: poppy 500ms linear both;
          animation: poppy 500ms linear both;
}
.popup figure img {
  position: relative;
  z-index: 2;
  border-radius: 15px;
  box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2), 0 6px 30px rgba(0, 0, 0, 0.4);
}
.popup figure figcaption {
  position: absolute;
  bottom: 50px;
  background: -webkit-linear-gradient(top, transparent, rgba(0, 0, 0, 0.78));
  background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.78));
  z-index: 2;
  width: 100%;
  border-radius: 0 0 15px 15px;
  padding: 100px 20px 20px 20px;
  color: #fff;
  font-family: 'Open Sans', sans-serif;
  font-size: 32px;
}
.popup figure figcaption small {
  font-size: 11px;
  display: block;
  text-transform: uppercase;
  margin-top: 12px;
  text-indent: 3px;
  opacity: .7;
  letter-spacing: 1px;
}
.popup figure .shadow {
  position: relative;
  z-index: 1;
  top: -15px;
  margin: 0 auto;
  background-position: center bottom;
  background-repeat: no-repeat;
  width: 98%;
  height: 50px;
  opacity: .6;
  -webkit-filter: blur(15px) contrast(2);
          filter: blur(15px) contrast(2);
}
.popup .close {
  position: absolute;
  z-index: 3;
  top: 10px;
  right: 10px;
  width: 25px;
  height: 25px;
  cursor: pointer;
  background: url(#close);
  border-radius: 25px;
  background: rgba(0, 0, 0, 0.1);
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
}
.popup .close svg {
  width: 100%;
  height: 100%;
}
</style>




@include('layouts/head')

@section('head')


@section('main-content')

  <!-- Icons Grid -->              
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
          <!-- El Modal -->   
          <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-screen-desktop m-auto text-primary" data-toggle="modal" data-target="#product_view"></i>
            </div>
            <h3 ><a data-toggle="modal" data-target="#product_view">  {{ __('messages.TituloPrincipal1') }}</a></h3>
            <p class="lead mb-0"><a data-toggle="modal" data-target="#product_view">  {{ __('messages.CuerpoPrincipal1') }}</a></p>
            <div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
     
       <!-- Galeria, dentro de modal -->   
        <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="row">
            <a href="{{url('/storage/'. $posts[19]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[19]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[6]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[6]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[7]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[7]->picturehotel )}}" class="img-fluid">
            </a>
        </div>
        <div class="row">
            <a href="{{url('/storage/'. $posts[8]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[8]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[9]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[9]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[10]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[10]->picturehotel )}}" class="img-fluid">
            </a>
        </div>
        <div class="row">
            <a href="{{url('/storage/'. $posts[11]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[11]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[12]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[12]->picturehotel )}}" class="img-fluid">
            </a>
            <a href="{{url('/storage/'. $posts[13]->picturehotel )}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                <img src="{{url('/storage/'. $posts[13]->picturehotel )}}" class="img-fluid">
            </a>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
            <a class="m-auto" href="{{ route('services') }}"><i class="icon-layers m-auto text-primary"></i></a>
            </div>
            <h3><a href="{{ route('services') }}"  style="color:#191919;">  {{ __('messages.TituloPrincipal2') }}</a></h3>
            <p class="lead mb-0"><a href="{{ route('services') }}"  style="color:black;">  {{ __('messages.CuerpoPrincipal2') }}</a></p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <a class="m-auto" href="{{ route('hotels') }}"><i class="icon-check m-auto text-primary"></i></a>
            </div>
            <h3><a href="{{ route('hotels') }}"  style="color:#191919;">  {{ __('messages.TituloPrincipal3') }}</a></h3>
            <p class="lead mb-0"><a href="{{ route('hotels') }}"  style="color:black;">  {{ __('messages.CuerpoPrincipal3') }}</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url({{url('/storage/'. $posts[2]->picturehotel )}});"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>{{ __('messages.Titulo1') }}</h2>
          <p class="lead mb-0">
          {{ __('messages.Cuerpo1') }}
      </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url({{url('/storage/'. $posts[3]->picturehotel )}});"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>{{ __('messages.Titulo2') }}</h2>
          <p class="lead mb-0">{{ __('messages.Cuerpo2') }}</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url({{url('/storage/'. $posts[4]->picturehotel )}});"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>{{ __('messages.Titulo3') }}</h2>
          <p class="lead mb-0">{{ __('messages.Cuerpo3') }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">{{ __('messages.Testimonio') }}</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="user/img/testimonials-1.jpg" alt="">
            <h5></h5>
            <p class="font-weight-light mb-0">{{ __('messages.Testimonio1') }}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="user/img/testimonials-1.jpg" alt="">
            <h5></h5>
            <p class="font-weight-light mb-0">{{ __('messages.Testimonio2') }}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="user/img/testimonials-1.jpg" alt="">
            <h5></h5>
            <p class="font-weight-light mb-0">{{ __('messages.Testimonio3') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">{{ __('messages.TituloFooter') }}</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <form enctype="multipart/form-data" novalidate="novalidate" method="POST" action=" {{ url('mail/send') }}">
          {{ csrf_field() }}
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
              <!-- <input type="email" class="form-control form-control-lg" placeholder="Digite seu email...">-->
                <input type="text" name="message" class="form-control form-control-lg" placeholder="...">
              </div>
              <div class="col-12 col-md-3">
                <button type="submit" class="btn btn-block btn-lg btn-primary" id="sendMessageButton">{{ __('messages.BotonFooter') }} !</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>



  
@if(isset($message))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">{{@message}}</span>
  </button>
</div>
@endif
@endsection
@section('footer')
@endsection
@extends('layouts/app')

 
@include('layouts/head4')



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
        top: 111px;
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

<br><br><br><br><br><br>
<body>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">{{ __('messages.Lista de Quartos') }}
          <small>são tomé e príncipe</small>
        </h1>
  @if (app()->getLocale() == "pt" )
        <!-- Blog Post -->
        <div class="card mb-4" >
          <img class="card-img-top" src="{{url('/storage/'. $posts[14]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$rooms[0]->name_room}}</h2>
            <p class="card-text"> {{$rooms[0]->pictureroom}} </p>
           
        <!--<a href="#" class="btn btn-primary">Leia mais &rarr;</a>--> 
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>   
        </div>

        <!-- Quarto 1-->
        <div class="card mb-4">
          <img class="card-img-top" src="{{url('/storage/'. $posts[15]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$rooms[2]->name_room}}</h2>
            <p class="card-text">{{$rooms[2]->pictureroom}}</p>
          
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>     
        </div>

        <!-- Quarto 2 -->
        <div class="card mb-4">
        <img class="card-img-top" src="{{url('/storage/'. $posts[16]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"> {{$rooms[4]->name_room}}</h2>
            <p class="card-text">{{$rooms[4]->pictureroom}}</p>
           
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>  
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{url('/storage/'. $posts[17]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"> {{$rooms[5]->name_room}}</h2>
            <p class="card-text">{{$rooms[5]->pictureroom}}</p>
          
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>  
        </div>
  @endif
 @if(app()->getLocale() == "en" )

 
        <!-- Blog Post -->
        <div class="card mb-4" >
          <img class="card-img-top" src="{{url('/storage/'. $posts[14]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$engs[0]->name_room}}</h2>
            <p class="card-text"> {{$engs[0]->pictureroom}}</p>
           
        <!--<a href="#" class="btn btn-primary">Leia mais &rarr;</a>--> 
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>   
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{url('/storage/'. $posts[15]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$engs[2]->name_room}}</h2>
            <p class="card-text">{{$engs[2]->pictureroom}}</p>
          
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>     
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
        <img class="card-img-top" src="{{url('/storage/'. $posts[16]->picturehotel )}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"> {{$engs[4]->name_room}}</h2>
            <p class="card-text">{{$engs[4]->pictureroom}}</p>
           
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>  
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{url('/storage/'. $posts[17]->picturehotel )}}" alt="Card image cap">       
          <div class="card-body">
            <h2 class="card-title">{{$engs[5]->name_room}}</h2>
            <p class="card-text">{{$engs[5]->pictureroom}}</p>
          
            <img src="user/img/rating.png" height="30" width="200" align="right">
          </div>  
        </div>

        
   @endif
 
        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
        
          </li>
          <li class="page-item disabled">
        
          </li>
        </ul>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget
         <div class="card my-4">
          <h5 class="card-header">Pesquisar</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Pesquise por...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>   
         -->
       
        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">{{ __('messages.Categorias') }}</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">{{ __('messages.Preços') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('messages.Quartos') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('messages.Localização') }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">{{ __('messages.Vagas') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('messages.Ofertas') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('messages.Promoções') }}</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Info</h5>
          <div class="card-body">{{ __('messages.Todos') }}
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->



</body>

@section('footer')
@endsection
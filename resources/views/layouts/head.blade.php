<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <!--  <title>{{ config('app.name', 'Roça Santo António Ecolodge') }}</title> -->
   

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Limpia campos de Search-->
    <script>
    function myFunction() {
     document.getElementById("myDate").value = "";
     document.getElementById("myDate1").value = "";
     document.getElementById("hotel").value = "Selecione hotel";
     document.getElementById("person").value = {{ __('messages.Persona') }};
    }
    </script>
</head>

  <!-- Bootstrap core CSS -->
  <link href="user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="user/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="user/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="user/css/landing-page.min.css" rel="stylesheet">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  
  <style>

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


</style>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                Roça Santo António Ecolodge  
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register1') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('messages.Lang') }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('locale/en') }}">
                                        en
                                    </a>
                                    <a class="dropdown-item" href="{{ url('locale/pt') }}">
                                       pt
                                    </a>
                                    

                                </div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        {{ __('Logout') }}
                                    </a>

                                </div>
                            </li>
                  
                    </ul>
                    &nbsp;
                  
                </div>
            </div>
        </nav>
  </nav>

  @section('head')
        @show

     
        <header class="masthead text-white text-center" with="23">
    
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-8 mx-auto">
          <h1 class="mb-5">{{ __('messages.welcome') }}</h1>
        </div>
        <div class="col-md-19 col-lg-28 col-xl-7 mx-auto">
        <div class="input-group">
              <div class="form-group">
                <br><br><br><br><br><br><br><br>    
     <section class="search-sec">
    <div class="container">
     <form action="/search" method="POST" role="search" >
     {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-19">
                    <div class="row">
                      <!--  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Enter Pickup Hotel">
                        </div>-->
                        
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
                        <div class="col-lg-3 col-md-2 col-sm-12 p-0" >   
                       
                          <!-- <input type='text' class="form-control search-slt"  placeholder="Check-in"  />    -->                
                             <input id="myDate23" type='date' class="form-control search-slt"  data-placeholder="Check-in" name='checkin' 
                             required="required" data-validation-required-message="Please enter a date." /> 
                                                                   
                        </div>
                                
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <input id="myDate24" type='date' class="form-control search-slt" placeholder="Check-out"  name='checkout'
                            required="required" data-validation-required-message="Please enter a date."/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select  required id="person" class="form-control search-slt" id="exampleFormControlSelect1"  name='person' 
                           >
                                <option value="">{{ __('messages.Persona') }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                     
                       
               
                        <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn"  onclick="myFunction()" ><i class='fas fa-search' style='font-size:16px'></i></button>
                          
                        </div>
                        
                    </div>
                </div>
            </div>
            <input type='hidden'  value={{ app()->getLocale() }}  name="lang"  style="width:20px height:5px;"/> 
        </form>
    </div>
    </section>
              </div>
        </div>
      </div>
    </div>
  </header>
  
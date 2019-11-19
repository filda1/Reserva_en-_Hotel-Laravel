@extends('layouts/app')



@section('main-content')


<body> 

@if(app()->getLocale() == "pt" )



<div class="card">
  <div class="card-header">
    Reserva
  </div>
  <div class="card-body">
  
    <p class="card-text"><div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Sucesso!</strong> Reserva bem sucedida
</div>
</p>
    <a href="{{ route('welcome') }}" class="btn btn-primary">Voltar</a>
  </div>
</div>

@else
<div class="card-header">
    Reservation
  </div>
  <div class="card-body">
   
    <p class="card-text"><div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> Successful booking.
</div>
</p>
    <a href="{{ route('welcome') }}" class="btn btn-primary">Back</a>
  </div>
</div>
<br>
@endif
 <br><br>
 <br><br><br>
 <br>
 <br><br>


</body>

@endsection
@section('footer')
@endsection



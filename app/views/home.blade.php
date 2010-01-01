@extends('layout')

@section('top')
  	@include('auth', array('user' => $user))
@stop

@section('content')
<h2>Onpopri</h2>
@if(Session::has('orderitem'))
    @include('orderitem')
@endif
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="" width="300px" height="300px" alt="poster">
      <div class="caption">
        <h3>Новый постер</h3>
        <p>Широкоформатная интерьерная печать выского качетсва и цветопередачи.</p>
        <p><a href="/orderitem/new" class="btn btn-primary" role="button">Заказать</a></p>
      </div>
    </div>
  </div>
</div>
@stop
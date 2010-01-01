@extends('layout')

@section('top')
  	@include('auth', array('user' => $user))
@stop

@section('content')
<h2>Новый заказ</h2>
<? php var_dump($order); ?>
{{ Debugbar::addMessage($order); }}
@stop
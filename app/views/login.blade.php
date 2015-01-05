@extends('layout')

@section('title')
Авторизация
@stop

@section('content')
@if(Session::has('message'))
    {{ Session::get('message')}}
@endif
<h2>Авторизация</h2>
<div class="row text-center">
	<p>Для оформления заказа нужно войти с помощью</p>
	<script src="https://apis.google.com/js/client:platform.js" async defer></script>
	<a href="/login/google">
		Google
	</a>
	<p>или</p>
	<p>Facebook</p>
</div>

@stop
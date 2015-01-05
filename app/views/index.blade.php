@extends('layout')

@section('title')
Онлайн принтер ожидает ваших приказов
@stop

@section('content')
@if(Session::has('message'))
    {{ Session::get('message')}}
@endif
<div class="row text-right">
@if (!empty($user))
    	<p>Hello, {{{ $user['name'] }}} </p>
    	<img src="{{ $user['photo']}}">
    	<p>Your email is {{ $user['email']}}</p>
    	<a href="logout">Logout</a>
@else
	<p>Войти с помощью Google или Facebook</p>
@endif
</div>
<h2>Online poster print</h2>
    <label for="url">Укажи ссылку на макет для печти:</label>
    <div class="input-group input-group-lg">
    	<span class="input-group-addon" id="sizing-addon1">URL</span>
    	<input type="text" class="form-control" id="url" placeholder="Ссылка на макет (ala Dropbox, etc)">
    </div>
    <br/>
    <div class="row">
    	<div class="col-md-2 col-md-offset-5">
    		<a href="/login">
    			<button type="button" class="btn btn-primary btn-lg btn-block">Start printing</button>
    		</a>
    	</div>
    </div>
@stop
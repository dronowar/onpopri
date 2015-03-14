@extends('layout')

@section('top')
  	@include('auth', array('user' => $user))
@stop

@section('content')
<h2>Новый постер</h2>
{{ Form::open(array('url' => action('OrderitemController@postNew', array('product_id' => '1')), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

@include('form')
<div class="form-group">
<div class="col-sm-2">&nbsp;</div>
<div class="col-sm-2">
		<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Цена</div>
		</div>
			<div id="price" class="panel-body">2 200 р.</div>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-3">
		<button type="submit" class="btn btn-primary submit-button">Заказать постер</button>
	</div>
</div>
{{ Form::close() }}
@stop
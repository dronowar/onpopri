@extends('layout')

@section('top')
  	@include('auth', array('user' => $user))
@stop

@section('content')
<h2>Мои заказы</h2>
@if(Session::has('error'))
	<div class="alert alert-danger" role="alert">{{ Session::pull('error') }}</div>
@endif
@if(Session::has('success'))
	<div class="alert alert-success" role="alert">{{ Session::pull('success') }}</div>
@endif
@if(Session::has('info'))
	<div class="alert alert-info" role="alert">{{ Session::pull('info') }}</div>
@endif
@foreach($orders as $order)
<table class="table table-bordered">
<tr>
<td width="50%">
<ul class="list-unstyled">
<li class="small">Номер заказа: #{{ $order['id'] }} от {{ $order['created_at'] }}</li>
<li class="small">Адрес доставки: {{ $order['delivery_adress'] }}</li>
<li class="small">Стоимость заказа: {{ $order['price'] }}</li>
</ul>
</td>
<td width="50%" class="text-center">
<h3>Статус заказа:</h3>
<p>{{ Lang::get('messages.status.'.$order['status']) }}</p>
@if ($order['status'] == 2)
{{ Form::open(array('url' => action('OrderController@postPayment', http_build_query($order)), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
	<div class="form-group">
	<label for="payment_method_id" class="col-sm-6 control-label">Выберите способ оплаты:</label>
	<div class="col-sm-4">
		{{ Form::select('payment_method_id', Order::$payments, null, array('class' => 'form-control')) }}
	</div>
	</div>
	<button type="submit" class="btn btn-success">Оплатить</button>
{{ Form::close() }}
@endif
</td>
</tr>
</table>
@endforeach
@stop
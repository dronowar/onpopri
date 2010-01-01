
<table class="table table-bordered">

<tr>
<td width="50%">
<table class="table orderitem_row">
@foreach (Session::get('orderitem') as $index => $item)
<tr id="orderitem_{{ $index }}">
<td>
    <h4>{{ Product::find($item['product_id'])->name }}</h4>
</td>
<td class="text-right"><a href="/orderitem/delete/{{ $index }}"><div class="label label-danger">[Х] Удалить</div></a></td>
</tr>
<tr><td colspan="2">
<ul class="list-unstyled">
	<li class="small">{{ Lang::get('messages.maket_url') }}: <strong>{{ Lang::get($item['details']['maket_url']) }}</strong></li>
	<li class="small">{{ Lang::get('messages.paper_id') }}: <strong>{{ Lang::get('messages.papers.'.$item['details']['paper_id']) }}</strong></li>
	<li class="small">{{ Lang::get('messages.colors') }}: <strong>{{ Lang::get('messages.color_count.'.$item['details']['colors']) }}</strong></li>
	<li class="small">{{ Lang::get('messages.paper_size_w') }}: <strong>{{ $item['details']['paper_size_w'] }} {{ Lang::get('messages.paper_size_demension') }}</strong></li>
	<li class="small">{{ Lang::get('messages.paper_size_h') }}: <strong>{{ $item['details']['paper_size_h'] }} {{ Lang::get('messages.paper_size_demension') }}</strong></li>
</ul>
</tr></td>
@endforeach
</table>
</td>
<td width="50%" class="text-center">
	<h3>Заказ</h3>
	
	{{ Form::open(array('url' => action('OrderController@postNew'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
	<div class="form-group">
	<label for="delivery_provider_id" class="col-sm-6 control-label">Выберите способ доставки:</label>
	<div class="col-sm-4">
		{{ Form::select('delivery_provider_id', Lang::get('messages.delivery_provider_id'), null, array('class' => 'form-control')) }}
	</div>
	</div>
	<div class="form-group">
	<div class="col-sm-12">
		Тула, ул. Рязанская, 8
	</div>
	</div>
	{{ Form::text('delivery_adress', 'Тула, ул. Рязанская, 8', array('class' => 'form-control hidden')) }}
	<button type="submit" class="btn btn-success">Оплатить</button>
	{{ Form::close() }}
	<br/>
	
</td>
</tr>

<tr>
<td>2200р.</td>
<td class="text-center"></td>
</tr>
</table>
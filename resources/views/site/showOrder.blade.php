@extends('site.template')

@section('content')
	<style>
		.social , .footer{
			display: none;
		}
	</style>
	<div class="container show-order">
		<table class="table table-bordered ">
			<tr>
				<td colspan="2"><h4>Order ID : #{{ $order->id }}</h4></td>
			</tr>
			<tr>
				<td>#</td>
				<td>Product</td>
				<td>Qty</td>
				<td>Price</td>
			</tr>
			@foreach($orderDetails as $detail)
			<tr>
				<td><a href="{{ url('/product/'.$detail->product->id.'-'.Str::slug($detail->product->name).'/show') }}">{{ $detail->product->id }}</a></td>
				<td>{{ $detail->product->name }}</td>
				<td>{{ $detail->amount }}</td>
				<td>{{ $detail->amount*$detail->product->price }}$</td>
			</tr>
			@if($detail->options)
					@foreach($options as $optionValue)
						@if($optionValue->option->product->id == $detail->product->id)
						<tr id="options">
							<td>{{ $optionValue->option->name }}</td>
							<td>{{ $optionValue->value }}</td>
						</tr>
						@endif
					@endforeach
				@endif
			@endforeach
			<tr>
				<td colspan="3">Total</td>
				<td>{{ $order->amount }}$</td>
			</tr>
			<tr>
				<td colspan="3">Payment Method</td>
				<td>{{ $order->payment_method }}</td>
			</tr>
		</table>
		<i class="fa fa-print fa-lg print" onClick="window.print()"></i>
	</div>
@stop
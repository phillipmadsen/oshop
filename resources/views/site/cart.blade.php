@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
	<style>
		.bottom-nav{
			display: none;
		}
	</style>
@stop

@section('content')
<div class="mycart">
<div class="process">
	<div class="container">
		<div class="row">
			<div class="col-xs-4">
				<span class="status-number current-status">1</span>
				<span class="status-name current-name">MY CART</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number">2</span>
				<span class="status-name">Shipping</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number">3</span>
				<span class="status-name">Payment</span>
			</div>
		</div>
	</div>
</div>

<div class="container">
<div class="cart-details">
<a href="{{ url('/cart/clear') }}" class="clear-cart"><i class="fa fa-trash-o"></i> Clear Cart</a>
<table class="table table-striped table-bordered table-responsive">
	<tr id="header">
		<td>#</td>
		<td></td>
		<td>NAME</td>
		<td>PRICE</td>
		<td>QTY</td>
		<td></td>
	</tr>
	@foreach($cart as $item)
	<tr class="product-{{ $item->product->id }}" prod-id="{{ $item->product->id }}" qty="{{ $item->amount }}">
		<form action="{{ url('/cart/add/'.$item->product->id) }}" class="edit-cart-form">
		<td><a href="{{ url('/product/'.$item->product->id.'-'.Str::slug($item->product->name).'/show') }}">{{ $item->product->id }}</a></td>
		<td class="thumbnail"> <img src="{{ $item->product->thumbnail }}"></td>
		<td>
		{{ $item->product->name }}
		@if($item->options)
			@foreach($options as $optionValue)
				@if($optionValue->option->product->id == $item->product->id)
					 - {{ $optionValue->value }} 
				@endif
			@endforeach
		@endif
		</td>
		<td>${{ $item->product->price*$item->amount }}</td>
		<td><input type="text" value="{{ $item->amount }}" class="qty" name="qty">
			<i class="fa fa-minus minus-cart-qty"></i>
			<i class="fa fa-plus plus-cart-qty"></i><br>
			<a href="#" class="save">save</a>
		</td>
		<td><a href="{{ url('/cart/remove/'.$item->product->id) }}" class="fa fa-times remove-item"></a></td>
		</form>
	</tr>
	@endforeach
	<tr class="total">
		<td colspan="3">Total</td>
		@if(Session::has('coupon'))
			<?php 
				$total = $total-(($total*Session::get('coupon.discount'))/100);
			?>
			<td>${{ $total }}</td>
		@else
			<td>${{ $total }}</td>
		@endif
	</tr>
</table>
</div>
<div class="row" id="coupon">
	<form action="/coupon/apply" method="post">
		<input type="text" placeholder="Promo Code/Coupon Code" name="coupon">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="submit" value="apply">
	</form>
</div>
<div class="row btns">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<a href="{{ url('/') }}" class="continue-shopping-btn">Continue shopping</a>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<a href="{{ url('/cart/shipping') }}" class="next-btn">NEXT STEP</a>
	</div>
</div>
</div>

</div>
@stop
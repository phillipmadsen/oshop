@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="container-fluid add-product show-order">

	<div class="row">
	<div class="col-md-12">	
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
			</tr>
			@endforeach
			@if($order->coupon)
				<tr>
					<td colspan="3">Discount</td>
					<td>{{ $order->coupon->discount }}%</td>
				</tr>
			@endif
			<tr>
				<td colspan="3">Total</td>
				<td>{{ $order->amount }}$</td>
			</tr>
			<tr>
				<td colspan="3">Payment Method</td>
				<td>{{ $order->payment_method }}</td>
			</tr>
		</table>
	</div>
	</div>

	<div class="row">
	<div class="col-md-7 shipping-info">
		<form action="{{ url('/order/'.$order->id.'/update') }}" method="post">
		<table class="table table-bordered">
			<tr>
				<td colspan="1"><h4>Shipping Information : </h4></td>
			</tr>
			<tr>
				<td>Receiver's Firstname</td>
				<td>{{ $order->firstname }}</td>
			</tr>
			<tr>
				<td>Receiver's Lastname</td>
				<td>{{ $order->lastname }}</td>
			</tr>
			<tr>
				<td>Shipping Country</td>
				<td>{{ $order->shipping_country }}</td>
			</tr>
			<tr>
				<td>Shipping City</td>
				<td>{{ $order->shipping_city }}</td>
			</tr>
			<tr>
				<td>Shipping Address</td>
				<td>{{ $order->shipping_address }}</td>
			</tr>
			<tr>
				<td>Shipping Zipcode</td>
				<td>{{ $order->shipping_zipcode }}</td>
			</tr>
			<tr>
				<td>Contact Phone</td>
				<td>{{ $order->phone }}</td>
			</tr>
			<tr>
				<td>Status : </td>
				<td>
					<select name="status" id="status" class="form-control">
						<option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
						<option value="Shipping" {{ $order->status == 'Shipping' ? 'selected' : '' }}>Shipping</option>
						<option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
						<option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }} >Delivered</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="btn btn-primary" value="Update Order Status">
				</td>
			</tr>
		</table>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
	<div class="col-md-5">
		<table class="table table-bordered">
			<tr>
				<td colspan="1"><h4>Customer ID : #{{ $order->user->id }}</h4></td>
			</tr>
			<tr>
				<td>Firstname</td>
				<td>{{ $order->user->userinfo->firstname }}</td>
			</tr>
			<tr>
				<td>Lastname</td>
				<td>{{ $order->user->userinfo->lastname }}</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>{{ $order->user->username }}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td>{{ $order->user->userinfo->phone }}</td>
			</tr>
		</table>
	</div>
	</div>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #orders').addClass('active-section');
	});
	</script>
@stop
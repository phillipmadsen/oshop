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
<div class="mycart shipping">
<div class="process">
<div class="container">
		<div class="row">
			<div class="col-xs-4">
				<span class="status-number">1</span>
				<span class="status-name">MY CART</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number current-status">2</span>
				<span class="status-name current-name">Shipping</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number">3</span>
				<span class="status-name">Payment</span>
			</div>
		</div>
	</div>
</div>

<div class="container info">
<h1>Shipping Information</h1>
@if($errors->any())
	<div class="alert alert-danger">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>	
		@endforeach
		</ul>
	</div>
@endif
<form action="{{ url('/cart/shipping') }}" method="post">
	<div class="row">
		<div class="form-group col-md-12">
			<label for="firstname" class=" control-label">Firstname : </label>
			<input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->userInfo->firstname }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="lastname" class=" control-label">Lastname : </label>
			<input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->userInfo->lastname }}">
		</div>
	</div>
<div class="row">
		<div class="form-group col-md-12">
			<label for="phone" class=" control-label">Phone : </label>
			<input id="phone" type="text" class="form-control" name="phone" value="{{ $user->userInfo->phone }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="address" class=" control-label">Address : </label>
			<textarea name="address" id="address" class="form-control">{{ $user->userInfo->address }}</textarea>
		</div>
	</div>
<div class="row">
		<div class="form-group col-md-12">
			<label for="city" class=" control-label">City : </label>
			<input id="city" type="text" class="form-control" name="city" value="{{ $user->userInfo->city }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="zipcode" class=" control-label">Zipcode : </label>
			<input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ $user->userInfo->zipcode }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="country" class=" control-label">Country : </label>
			<input id="country" type="text" class="form-control" name="country" value="{{ $user->userInfo->country }}">
		</div>
	</div>
	<div class="row submit">
		<div class="form-group col-md-12">
			<input type="submit" value="continue" class="continue-btn">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
</div>

</div>
@stop
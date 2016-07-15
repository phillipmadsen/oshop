@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
	<style>
		.bottom-nav{
			display : none;
		}
	</style>
	<div class="dashboard-banner">Dashboard</div>
@stop

@section('content')
<div class="container dashboard">
<ul class="nav nav-tabs nav-justified" role="tablist">
	<li role="presentation" class="active"><a href="#profile" aria-expanded="true" aria-controls="profile" role="tab" data-toggle="tab">Account</a></li>
    <li role="presentation"><a href="#security" aria-controls="security" role="tab" data-toggle="tab">Shipping Information</a></li>
    <li role="presentation"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Orders</a></li>
</ul>
@if($errors->any())
	<div class="alert alert-danger">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>	
		@endforeach
		</ul>
	</div>
@endif
<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active col-md-offset-2" id="profile">
	<form action="{{ url('/dashboard/editAccount') }}" method="post" enctype="multipart/form-data">
	<img src="{{ $user->userInfo->photo }}">
	<div class="row">
		<div class="form-group col-md-9">
			<label for="photo" class=" control-label">Photo : </label>
			<input type="file" class="form-control" name="photo">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="username" class=" control-label">Username : </label>
			<input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" disabled>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="email" class=" control-label">Email : </label>
			<input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="old_password" class=" control-label">Old Passowrd : </label>
			<input id="old_password" type="password" class="form-control" name="old_password" value="">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="new_password" class=" control-label">New Passowrd : </label>
			<input id="new_password" type="password" class="form-control" name="new_password" value="">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="new_password_confirmation" class=" control-label">Confirm New Passowrd : </label>
			<input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" value="">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<input id="submit" type="submit" class="form-control btn btn-primary " value="Save">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
	</div>
	<div role="tabpanel" class="tab-pane fade col-md-offset-2" id="security">
	<div class="row">
	<form action="{{ url('/dashboard/editInfo') }}" method="post">
		<div class="form-group col-md-9">
			<label for="firstname" class=" control-label">Firstname : </label>
			<input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->userInfo->firstname }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="lastname" class=" control-label">Lastname : </label>
			<input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->userInfo->lastname }}">
		</div>
	</div>
<div class="row">
		<div class="form-group col-md-9">
			<label for="phone" class=" control-label">Phone : </label>
			<input id="phone" type="text" class="form-control" name="phone" value="{{ $user->userInfo->phone }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="address" class=" control-label">Address : </label>
			<textarea name="address" id="address" class="form-control">{{ $user->userInfo->address }}</textarea>
		</div>
	</div>
<div class="row">
		<div class="form-group col-md-9">
			<label for="city" class=" control-label">City : </label>
			<input id="city" type="text" class="form-control" name="city" value="{{ $user->userInfo->city }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="zipcode" class=" control-label">Zipcode : </label>
			<input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ $user->userInfo->zipcode }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="country" class=" control-label">Country : </label>
			<input id="country" type="text" class="form-control" name="country" value="{{ $user->userInfo->country }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<input id="submit" type="submit" class="form-control btn btn-primary" value="Save">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="orders">
		<table class="table table-striped table-bordered">
			<tr id="table-header">
				<td>#</td>
				<td>Items</td>
				<td>Status</td>
				<td>Total</td>
			</tr>
			@foreach($user->orders()->orderBy('created_at','desc')->get() as $order)
			<tr class="clickable" data-href="{{ url('/order/'.$order->id.'/show') }}">
				<td>{{ $order->id }}</td>
				<td>{{ $order->products->count() }}</td>
				<td>{{ $order->status }}</td>
				<td>${{ $order->amount }}</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
</div>
@stop
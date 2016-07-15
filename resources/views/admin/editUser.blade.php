@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="container-fluid add-product">
	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>	
			@endforeach
			</ul>
		</div>
	@endif
	<form action="/user/{{ $user->id }}/edit" method="post">
	<div class="row">
		<div class="form-group col-md-5">
			<img src="{{ $user->userInfo->photo }}" height="200" width="200">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="isadmin" class="control-label">Type : </label>
			<select name="isAdmin" id="isadmin">
				<option value="0" {{ $user->isAdmin == 0 ? 'selected' : '' }}>User</option>
				<option value="1" {{ $user->isAdmin == 1 ? 'selected' : '' }}>Admin</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="username" class=" control-label">Username : </label>
			<input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="firstname" class=" control-label">Firstname : </label>
			<input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->userInfo->firstname }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="lastname" class=" control-label">Lastname : </label>
			<input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->userInfo->lastname }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="email" class=" control-label">Email : </label>
			<input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="phone" class=" control-label">Phone : </label>
			<input id="phone" type="text" class="form-control" name="phone" value="{{ $user->userInfo->phone }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="address" class=" control-label">Address : </label>
			<input id="address" type="text" class="form-control" name="address" value="{{ $user->userInfo->address }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="city" class=" control-label">City : </label>
			<input id="city" type="text" class="form-control" name="city" value="{{ $user->userInfo->city }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="zipcode" class=" control-label">Zipcode : </label>
			<input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ $user->userInfo->zipcode }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="country" class=" control-label">Country : </label>
			<input id="country" type="text" class="form-control" name="country" value="{{ $user->userInfo->country }}">
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-7">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Edit User">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #users').addClass('active-section');
	});
	</script>
@stop
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
	<form action="/user/create" method="post">
	<div class="row">
		<div class="form-group col-md-5">
			<label for="username" class=" control-label">Username : </label>
			<input id="username" type="text" class="form-control" name="username">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="password" class=" control-label">Password : </label>
			<input id="password" type="password" class="form-control" name="password">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="password" class=" control-label">Confirm Password : </label>
			<input id="password" type="password" class="form-control" name="password_confirmation">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="email" class=" control-label">Email : </label>
			<input id="email" type="text" class="form-control" name="email">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="isAdmin" class=" control-label">Type : </label>
			<select name="isAdmin" id="isAdmin">
				<option value="0">User</option>
				<option value="1">Admin</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Add User">
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
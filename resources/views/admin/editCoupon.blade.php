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
	<form action="/coupon/{{ $coupon->id }}/edit" method="post">
	<div class="row">
		<div class="form-group col-md-4">
			<label for="name" class="control-label">Coupon Code : </label>
			<input id="name" type="text" class="form-control" name="name" value="{{ $coupon->name }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="discount" class="control-label">Discount Percentage % : </label>
			<input id="discount" type="text" class="form-control" name="discount" value="{{ $coupon->discount }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="uses" class="control-label">Maximum Usage per User : </label>
			<input id="uses" type="text" class="form-control" name="uses" value="{{ $coupon->uses }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Edit Coupon">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #coupons').addClass('active-section');
	});
	</script>
@stop
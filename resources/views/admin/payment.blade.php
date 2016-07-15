@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')

<div class="container-fluid add-product">
	<h3>Stripe API Keys : </h3><br>
	<form action="" method="post">
	<div class="row">
		<div class="form-group col-md-9">
			<label for="secret_key" class=" control-label">Secret Key : </label>
			<input id="secret_key" type="text" class="form-control" name="stripe_secret_key" value="{{ $payment->stripe_secret_key }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="publishable_key" class=" control-label">Publishable Key : </label>
			<input id="publishable_key" type="text" class="form-control" name="stripe_publishable_key" value="{{ $payment->stripe_publishable_key }}">
		</div>
	</div>
	<h3>Paypal API Keys : </h3><br>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="paypal_client_id" class=" control-label">Client ID : </label>
			<input id="paypal_client_id" type="text" class="form-control" name="paypal_client_id" value="{{ $payment->paypal_client_id }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<label for="paypal_secret" class=" control-label">Secret : </label>
			<input id="paypal_secret" type="text" class="form-control" name="paypal_secret" value="{{ $payment->paypal_secret }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-9">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Save">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #payment').addClass('active-section');
	});
	</script>
@stop
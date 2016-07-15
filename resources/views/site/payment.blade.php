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
<div class="mycart shipping payment">
<div class="process">
<div class="container">
		<div class="row">
			<div class="col-xs-4">
				<span class="status-number">1</span>
				<span class="status-name">MY CART</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number">2</span>
				<span class="status-name">Shipping</span>
			</div>
			<div class="col-xs-4">
				<span class="status-number current-status">3</span>
				<span class="status-name current-name">Payment</span>
			</div>
		</div>
	</div>
</div>

<div class="container info">
<div class="header">
	<h1>Billing Information</h1>
	<p>Choose a payment option bellow and fill out <br>the appropriate information</p>
</div>
<span class="payment-errors"></span>
<div class="payment-options">
	<div class="row">
		<div class="col-md-2 col-md-offset-4">
			<div class="credit-card selected-payment"><i class="fa fa-credit-card fa-5x"></i></div>
		</div>
		<div class="col-md-2 clickable" data-href="{{ url('/payment/paypal') }}">
			<div class="paypal"><i class="fa fa-paypal fa-5x"></i></div>
		</div>
	</div>
</div>
<form action="{{ url('/cart/payment') }}" method="post" class="col-md-offset-3" id="payment-form">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="ccnum" class="control-label">Card Number : </label>
			<input id="ccnum" type="text" class="form-control" data-stripe="number">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-8">
			<div class="row">
				<div class="col-md-6">
					<label for="expm" class="control-label">EXP MONTH : </label>
					<select id="expm" data-stripe="exp-month" class="form-control">
						<option value="">MONTH</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</div>
				<div class="col-md-6">
					<label for="expm" class="control-label">EXP YEAR : </label>
					<select id="expy" data-stripe="exp-year" class="form-control">
						<option value="">YEAR</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
						<option value="2026">2026</option>
						<option value="2027">2027</option>
						<option value="2028">2028</option>
						<option value="2029">2029</option>
						<option value="2030">2030</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="cvc" class="control-label">CVC Number : </label>
			<input id="cvc" type="text" class="form-control" data-stripe="cvc" placeholder="CVC">
		</div>
	</div>
	<div class="row payment-confirm">
		<div class="form-group col-md-8">
			<input type="submit" class="payment-btn" value="Confirm & Pay" id="sub-btn">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
</div>

</div>
@stop


@section('footer')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
	$(document).ready(function(){
		Stripe.setPublishableKey("{{ $publishable_key }}");

		$( "#payment-form" ).submit(function( event ) {
  			var form = $(this);
  			
		    // No pressing the buy now button more than once
		    form.find('sub-btn').prop('disabled', true);
		 
		    // Create the token, based on the form object
		    Stripe.card.createToken(form, stripeResponseHandler);
		 
		    // Prevent the form from submitting
  			event.preventDefault();
		});
		 
		var stripeResponseHandler = function(status, response) {
			var form = $('#payment-form');

			// Any validation errors?
			if (response.error) {
			    // Show the user what they did wrong
			    form.find('.payment-errors').text(response.error.message);

			    // Make the submit clickable again
			    form.find('#sub-btn').prop('disabled', false);
			} else {
			    // Otherwise, we're good to go! Submit the form.
			    // Insert the unique token into the form
			    $('<input>', {
			        'type': 'hidden',
			        'name': 'stripeToken',
			        'value': response.id
			    }).appendTo(form);

			    // Call the native submit method on the form
			    // to keep the submission from being canceled
			    form.get(0).submit();
			}
		};

	});
</script>
@stop
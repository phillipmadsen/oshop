@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
@stop

@section('content')
	<div class="container contact">
		<form action="{{ url('/contact') }}" method="post">
			<div class="title">
				Contact Form
			</div>
			<div class="row">
				<div class="form-group col-md-7 col-md-offset-2">
					<label for="name" class="control-label">Full Name : </label>
					<input id="name" type="text" class="form-control" name="name">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-7 col-md-offset-2">
					<label for="email" class="control-label">Contact Email : </label>
					<input id="email" type="text" class="form-control" name="email">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-7 col-md-offset-2">
					<label for="subject" class="control-label">Subject : </label>
					<input id="subject" type="text" class="form-control" name="subject">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-7 col-md-offset-2">
					<textarea name="message" id="" class="form-control"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-7 col-md-offset-4">
					<input type="submit" id="send-message" value="Send message">
				</div>
			</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
@stop
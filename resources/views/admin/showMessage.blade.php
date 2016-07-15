@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="container-fluid add-product show-message">
	<a href="{{ url('/message/'.$message->id.'/delete') }}" class="delete-btn">Delete Message</a>
	<h3>{{ $message->subject }}</h3>
	<p>Reply-To : <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
	<p>Name : {{ $message->name }}</p>
	<p>User : {{ $message->user_id ? $message->user->username : "Guest" }}</p>
	<article class="col-md-10">{{ $message->message }}</article>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #messages').addClass('active-section');
	});
	</script>
@stop
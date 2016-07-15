@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="messages">
<div class="container">
	<div class="no-messages" style="{{ count($messages) == 0 ? '' : 'display:none;' }}">
	You Have No Messages !!
</div>
</div>
<table class="table">
	@foreach($messages as $message)
	<a href="/"><tr class="clickable-row {{ !$message->opened ? 'not-opened' : ''}}" data-href="{{ url('/admin/message/'.$message->id) }}">
		<td>{{ $message->email }}</td>
		<td>{{ str_limit($message->subject,40,' ...') }}</td>
		<td>{{ str_limit($message->message,100,' ...') }}</td>
		<td>{{ $message->created_at->diffForHumans() }}</td>
    </tr></a>
	@endforeach
</table>
{!! $messages->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #messages').addClass('active-section');
	});
	</script>
@stop

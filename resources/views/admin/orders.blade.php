@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="orders">
<table class="table">
	<tr id="table-header">
		<td><a href="{{ url(Request::url().'?sort=id&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}"># {!! Request::get('sort') == 'id' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=amount&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Amount {!! Request::get('sort') == 'amount' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=user_id&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">User {!! Request::get('sort') == 'user_id' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=user_id&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Email {!! Request::get('sort') == 'user_id' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=status&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Status {!! Request::get('sort') == 'status' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=created_at&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Date {!! Request::get('sort') == 'created_at' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
	</tr>
	@foreach($orders as $order)
	<tr class="clickable-row {{ !$order->opened ? 'not-opened' : ''}}" data-href="{{ url('/admin/order/'.$order->id) }}">
		<td>{{ $order->id }}</td>
		<td>{{ $order->amount }}$</td>
		<td>{{ $order->user->username }}</td>
		<td>{{ $order->user->email }}</td>
		<td>{{ $order->status }}</td>
		<td>{{ $order->created_at->toFormattedDateString() }}</td>
	</tr>
	@endforeach
</table>
{!! $orders->appends([
		'sort' => Request::get('sort'),
		'orderby' => Request::get('orderby')
	])->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #orders').addClass('active-section');
	});
	</script>
@stop
@extends('admin.template')


@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="pages">
<a class="fa fa-plus add-btn" href="{{ url('/admin/coupon/create') }}">Add Coupon</a>
<table class="table">
	<tr id="table-header">
		<td>#</td>
		<td>Code</td>
		<td>Discount</td>
		<td>Maximum Usage</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($coupons as $coupon)
	<tr>
		<td>{{ $coupon->id }}</td>
		<td>{{ $coupon->name }}</td>
		<td>{{ $coupon->discount }}%</td>
		<td>{{ $coupon->uses }} {{ $coupon->uses == 1 ? 'Time' : 'Times' }}</td>
		<td><a href="{{ url('/admin/coupon/'.$coupon->id.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/coupon/'.$coupon->id.'/delete') }}" class="fa fa-times"></a></td>
	</tr>
	@endforeach
</table>
{!! $coupons->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #coupons').addClass('active-section');
	});
	</script>
@stop
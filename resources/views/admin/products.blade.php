@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="products">
<a class="fa fa-plus add-btn" href="{{ url('/admin/product/create') }}">Add Product</a>
<table class="table">
	<tr id="table-header">
		<td><a href="{{ url(Request::url().'?sort=id&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}"># {!! Request::get('sort') == 'id' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=name&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Name {!! Request::get('sort') == 'name' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=manufacturer&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Manufacturer {!! Request::get('sort') == 'manufacturer' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=price&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Price {!! Request::get('sort') == 'price' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=quantity&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Qty {!! Request::get('sort') == 'quantity' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td>Categories</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($products as $product)
	<tr>
		<td><a href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">{{ $product->id }}</a></td>
		<td>{{ $product->name }}</td>
		<td>{{ $product->manufacturer }}</td>
		<td>${{ $product->price }}</td>
		<td>{{ $product->quantity }}</td>
		<td>
			<?php 
                $categories = [];
                foreach ($product->categories as $category) {
                    $categories[] = $category->name;
                }
            ?>
			{{ count($categories) == 1 ? $categories[0] :  str_limit(implode(' | ', $categories),30,' ...') }}
		</td>
		<td><a href="{{ url('/admin/product/'.$product->id.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/product/'.$product->id.'/delete') }}" class="fa fa-times"></a></td>
    </tr>
	@endforeach
</table>
{!! $products->appends([
		'sort' => Request::get('sort'),
		'orderby' => Request::get('orderby')
	])->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #products').addClass('active-section');
	});
	</script>
@stop
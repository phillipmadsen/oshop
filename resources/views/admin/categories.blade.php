@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="categories">
<a class="fa fa-plus add-btn" href="{{ url('/admin/category/create') }}">Add Category</a>
<table class="table">
	<tr id="table-header">
		<td>#</td>
		<td>Name</td>
		<td>Products</td>
		<td>Section</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($categories as $category)
	<tr>
		<td>{{ $category->id }}</td>
		<td>{{ $category->name }}</td>
		<td>{{ $category->products->count() }}</td>
		<td>{{ $category->section ? $category->section->name : '' }}</td>
		<td><a href="{{ url('/admin/category/'.$category->id.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/category/'.$category->id.'/delete') }}" class="fa fa-times"></a></td>
    </tr>
	@endforeach
</table>
{!! $categories->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #categories').addClass('active-section');
	});
	</script>
@stop
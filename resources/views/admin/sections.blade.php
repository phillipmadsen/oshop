@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="sections">
<a class="fa fa-plus add-btn" href="{{ url('/admin/section/create') }}">Add Section</a>
<table class="table">
	<tr id="table-header">
		<td><a href="{{ url(Request::url().'?sort=id&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}"># {!! Request::get('sort') == 'id' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td><a href="{{ url(Request::url().'?sort=name&orderby=') }}{{ Request::get('orderby') == 'asc' ? 'desc' : 'asc'}}">Name {!! Request::get('sort') == 'name' ? ( Request::get('orderby') == 'desc' ? '<i class="fa fa-angle-down"></i>' : '<i class="fa fa-angle-up"></i>' ) : '' !!}</a></td>
		<td>Categories</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($sections as $section)
	<tr>
		<td>{{ $section->id }}</td>
		<td>{{ $section->name }}</td>
		<td>{{ $section->categories->count() }}</td>
		<td><a href="{{ url('/admin/section/'.$section->id.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/section/'.$section->id.'/delete') }}" class="fa fa-times"></a></td>
    </tr>
	@endforeach
</table>
{!! $sections->appends([
		'sort' => Request::get('sort'),
		'orderby' => Request::get('orderby')
	])->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #sections').addClass('active-section');
	});
	</script>
@stop
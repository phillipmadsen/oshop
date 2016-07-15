@extends('admin.template')


@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="pages">
<a class="fa fa-plus add-btn" href="{{ url('/admin/page/create') }}">Create Page</a>
<table class="table">
	<tr id="table-header">
		<td>Title</td>
		<td>Name</td>
		<td>Url</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($pages as $page)
	<tr>
		<td>{{ $page->page_title }}</td>
		<td>{{ $page->page_name }}</td>
		<td><a href="{{ url('/pages/'.$page->page_name) }}">/pages/{{ $page->page_name }}</a></td>
		<td><a href="{{ url('/admin/page/'.$page->page_name.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/page/'.$page->page_name.'/delete') }}" class="fa fa-times"></a></td>
    </tr>
	@endforeach
</table>
{!! $pages->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #pages').addClass('active-section');
	});
	</script>
@stop
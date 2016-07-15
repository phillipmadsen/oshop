@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="container-fluid add-product">

<form action="/page/{{ $page->page_name }}/edit" method="post">
	<div class="row">
		<div class="form-group col-md-10">
			<label for="page_title" class=" control-label">Page Title : </label>
			<input id="page_title" type="text" class="form-control" name="page_title" value="{{ $page->page_title }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			{{-- <label for="page_name" class=" control-label">Page Name : </label> --}}
			<div class="row">
				<div class="col-md-3">
					<span>/pages/</span>
				</div>
				<div class="col-md-8">
					<input id="page_name" type="text" class="form-control" name="page_name" placeholder="page name" value="{{ $page->page_name }}">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-10">
			<textarea name="page_source" id="page_source">{!! $page->page_source !!}</textarea>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-10">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Edit Page">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>

</div>
@stop

@section('footer')
	<script src="/ckeditor-standard/ckeditor.js"></script>
	<script>
	$(document).ready(function(){
		CKEDITOR.replace('page_source');
		$('.sidebar #pages').addClass('active-section');
	});
	</script>
@stop
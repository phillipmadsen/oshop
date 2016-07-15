@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="container-fluid add-product">
	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>	
			@endforeach
			</ul>
		</div>
	@endif
	<form action="/category/{{ $category->id }}/edit" method="post">
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name" class=" control-label">Category Name : </label>
			<input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name" class="control-label">Section : </label>
			<select name="section_id" class="form-control">
				@foreach($sections as $section)
					<option value="{{ $section->id }}" {{ $category->section_id == $section->id ? 'selected' : ''}}>{{ $section->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Edit Category">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #categories').addClass('active-section');
	});
	</script>
@stop
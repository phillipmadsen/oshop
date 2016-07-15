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
	<form action="/product/create" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name" class=" control-label">Product Name : </label>
			<input id="name" type="text" class="form-control" name="name">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="manufacturer">Manufacturer : </label>
			<input id="manufacturer" type="text" class="form-control" name="manufacturer">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="price">Price : </label>
			<input id="price" type="text" class="form-control" name="price">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="details">Details : </label>
			<textarea name="details" id="details" cols="30" rows="10" class="form-control"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="quantity">Quantity : </label>
			<input name="quantity" id="quantity" type="text" class="form-control ">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="categories">Categories : </label>
			<select class="form-control" name="categories[]" id="categories" multiple>
				@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="thumbnail">Thumbnail Photo : </label>
			<input id="thumbnail" name="thumbnail" type="file" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">

			<label for="album">Photo Album : </label>
			<input id="album" type="file" name="album[]" class="form-control">
			<div class="album"></div>
			<div id="add_album_image">Add Image</div>
			
		</div>
	</div>
	<hr>
	<div class="row options">
		<div class="form-group col-md-12">
			<label for="options">Product Options : </label>
			<div id="add_product_option">Add Option</div>
			<div class="options-group row">
				<div class="option col-md-3" op-index="0">
					<span class="fa fa-times fa-lg remove-option"></span>
					<label for="options">Option Name : </label>
					<input type="text" name="options[0][name]"><br>
					<div class="add_option_value">+ Add Value</div>
					<ul class="values">
						<li><input type="text" name="options[0][values][]"></li>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Add Product">
		</div>
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	</form>
</div>
@stop

@section('footer')
	<script src="/ckeditor-basic/ckeditor.js"></script>
	<script>
	$(document).ready(function(){
		CKEDITOR.replace('details');
		var options_counter = 0;
		$('.sidebar #products').addClass('active-section');

		$('#add_album_image').click(function(){
			$('.album').append('<input id="album" type="file" name="album[]" class="form-control">');
		});

		$('#add_product_option').click(function(){
			options_counter++;
			$('.options-group').append('<div class="option col-md-3" op-index="'+options_counter+'"><span class="fa fa-times fa-lg remove-option"></span><label for="options">Option Name : </label><input type="text" name="options['+options_counter+'][name]"><br><div class="add_option_value">+ Add Value</div><ul class="values"><li><input type="text" name="options['+options_counter+'][values][]"></li></ul></div>');
		});

		$(document).on("click", ".remove-option", function() {
			$(this).parent().remove();
		});

		$(document).on("click", ".add_option_value", function() {
			$(this).parent().find('.values').append('<li><input type="text" name="options['+$(this).parent().attr('op-index')+'][values][]"><i class="fa fa-minus remove-value"></i></li>');
		});

		$(document).on("click", ".remove-value", function() {
			$(this).parent().remove();
		});

	});
	
	</script>
@stop
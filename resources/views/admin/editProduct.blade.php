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
	<form action="/product/{{ $product->id }}/edit" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name" class=" control-label">Product Name : </label>
			<input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-5">
			<label for="manufacturer">Manufacturer : </label>
			<input id="manufacturer" type="text" class="form-control" name="manufacturer" value="{{ $product->manufacturer }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="price">Price : </label>
			<input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="details">Details : </label>
			<textarea name="details" id="details" cols="30" rows="10" class="form-control">{{ $product->details }}</textarea>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="quantity">Quantity : </label>
			<input name="quantity" id="quantity" type="text" class="form-control " value="{{ $product->quantity }}">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="categories">Categories : </label>
			<select class="form-control" name="categories[]" id="categories" multiple="multiple">
				@foreach($categories as $category)
					<option value="{{ $category->id }}" 
						@foreach($product->categories as $cat)
							{{$category->id == $cat->id ? 'selected' : ''}}
						@endforeach
					>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<label for="thumbnail">Thumbnail Photo : </label>
			<img src="{{ $product->thumbnail }}" alt="thumbnail" height="200" width="200">
			<input id="thumbnail" name="thumbnail" type="file" class="form-control ">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label for="thumbnail">Photo Album : </label>
			
			<div class="row">
				@foreach($product->photos as $photo)
					<div class="col-md-3">
						<img src="{{ $photo->photo_src }}" height="150" width="150">
						<span class="fa fa-trash-o fa-lg remove-photo clickable" data-href="{{ url('/product/'.$product->id.'/photo/'.$photo->id.'/delete') }}"></span>
					</div>
				@endforeach
			</div>
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
				@foreach($product->options as $key => $option)
				<div class="option col-md-3" op-index="{{ $key }}">
					<input type="hidden" name="options[{{ $key }}][id]" value="{{ $option->id }}">
					<span class="fa fa-times fa-lg remove-option-edit clickable" data-href="{{ url('/option/'.$option->id.'/delete') }}"></span>
					<label for="options">Option Name : </label>
					<input type="text" name="options[{{ $key }}][name]" value="{{ $option->name }}"><br>
					<div class="add_option_value">+ Add Value</div>
					<ul class="values">
						@foreach($option->values as $value)
						<input type="hidden" name="options[{{ $key }}][values][id][]" value="{{ $value->id }}">
							<li><input type="text" value="{{ $value->value }}" name="options[{{ $key }}][values][name][]"><i class="fa fa-minus remove-value-edit clickable" data-href="{{ url('/optionvalue/'.$value->id.'/delete') }}"></i></li>
						@endforeach
					</ul>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-7">
			<input id="submit" type="submit" class="form-control btn btn-primary prod-submit" value="Edit Product">
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
		$(".clickable-row , .clickable").click(function() {
	        window.document.location = $(this).data("href");
	    });

		var options_counter = Number({{ $product->options->count() }})-1;

	    $('#add_album_image').click(function(){
			$('.album').append('<input id="album" type="file" name="album[]" class="form-control">');
		});

		$('.sidebar #products').addClass('active-section');

		$('#add_product_option').click(function(){
			options_counter++;
			$('.options-group').append('<div class="option col-md-3" op-index="'+options_counter+'"><span class="fa fa-times fa-lg remove-option"></span><label for="options">Option Name : </label><input type="text" name="options['+options_counter+'][name]"><br><div class="add_option_value">+ Add Value</div><ul class="values"><li><input type="text" name="options['+options_counter+'][values][name][]"></li></ul></div>');
		});

		$(document).on("click", ".remove-option", function() {
			$(this).parent().remove();
		});

		$(document).on("click", ".add_option_value", function() {
			$(this).parent().find('.values').append('<li><input type="text" name="options['+$(this).parent().attr('op-index')+'][values][name][]"><i class="fa fa-minus remove-value"></i></li>');
		});

		$(document).on("click", ".remove-value", function() {
			$(this).parent().remove();
		});
	});
	</script>
@stop
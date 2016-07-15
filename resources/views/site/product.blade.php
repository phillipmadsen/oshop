@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
@stop

@section('content')
<div class="product">
<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12 images">
			<div class="main">
				<img src="{{ $product->thumbnail }}">
			</div>
			<div class="album">
				<ul>
					@foreach($product->photos as $photo)
						<li class="col-md-2 col-sm-2 col-xs-2">
							<img src="{{ $photo->photo_src }}" class="display-img">
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="col-md-5 col-md-offset-1 info col-sm-12 col-xs-12" >
			<div class="name">{{ $product->name }}</div>
			<div class="manufacturer">Manufacturer : {{ $product->manufacturer }}</div>
			<hr>
			<form action="{{ $product->quantity ? url('/cart/add/'.$product->id) : '' }}">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="add-qty">
							<i class="fa fa-minus" id="minus-qty"></i>
							<i class="fa fa-plus" id="plus-qty"></i>
							<input type="text" name="qty" class="qty" value="1">
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="price">${{ $product->price }}</div><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						Share with friends <br>
						<a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" class="share fa fa-facebook"></a>
						<a href="https://twitter.com/home?status={{ Request::url() }}" class="share fa fa-twitter"></a>
						<a href="#" class="share fa fa-share-square-o"></a>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<input type="submit" class="add-cart {{ $product->quantity ? '' : 'out-of-stock' }}" value="{{ $product->quantity ? 'ADD TO CART' : 'OUT OF STOCK' }}">
					</div>
				</div>
				@if($product->options)
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<ul>
								@foreach($product->options as $option)
									<li>
									{{ $option->name }} : 
									<select name="options[]" class="form-control">
										@foreach($option->values as $value)
											<option value="{{ $value->id }}">{{ $value->value }}</option>
										@endforeach
									</select>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif
			</form>
			<div class="row description">
				<div class="heading">Product Description : </div>
				<div class="detail">
				{!! $product->details !!}
			</div>
			</div>
		</div>
	</div>
</div>
@if($similair->count())
<div class="more-info">
<div class="container-fluid">
	<div class="col-md-12 ">
		<div class="heading">SIMILAR products</div>
		<ul class="products">
			@foreach($similair as $product)
			<li class="item clickable" data-href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">
				<div class="row">
					<div class="col-md-2 col-sm-2 col-xs-2 image">
						<img src="{{ $product->thumbnail }}">
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9 prod-details">
						<div class="name">{{ $product->name }}</div>
						{{ str_limit(htmlspecialchars_decode(strip_tags($product->details)),250,' ...') }}
						
					</div>
					<div class="col-md-2 prod-price">
						${{ $product->price }}
					</div>
				</div>
				<hr>
			</li>
			@endforeach
		</ul>
	</div>
</div>
</div>
@endif
</div>
@stop
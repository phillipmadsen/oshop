@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
	<div class="cover">
		<p class="welcome-msg">Welcome to our web store</p>
		<p class="msg">Feel Free to Look around.</p>
	</div>
@stop

@section('content')
<div class="container index">

<div class="section">
	<div class="section-name row">New Products</div>
	<div class="row">
		<div class="items">
			@foreach($new_products as $product)
				<div class="item col-md-3 col-sm-3 col-xs-6 clickable" data-href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">
					<div class="photo"><img src="{{ $product->thumbnail }}">{!! $product->created_at >= Carbon\Carbon::now()->subweek() ? '<span class="new-product">NEW</span>' : '' !!}</div>
					<div class="name">{{ str_limit($product->name,30,' ...') }}</div>
					<div class="description">
						{{ str_limit(htmlspecialchars_decode(strip_tags($product->details)),45,' ...') }}
					</div>
					<div class="price-buy">
						<div class="price">${{ $product->price }}</div><a class="buy fa fa-cart-plus fa-2x" href="{{ $product->options->count() ? url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') : url('/cart/add/'.$product->id.'/?qty=1') }}"></a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

<div class="section">
	<div class="section-name row">BEST SELLERS</div>
	<div class="row">
		<div class="items">
			@foreach($best_sellers as $product)
				<div class="item col-md-3 col-sm-3 col-xs-6 clickable" data-href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">
					<div class="photo"><img src="{{ $product->thumbnail }}">{!! $product->created_at >= Carbon\Carbon::now()->subweek() ? '<span class="new-product">NEW</span>' : '' !!}</div>
					<div class="name">{{ $product->name }}</div>
					<div class="description">
						{{ str_limit(htmlspecialchars_decode(strip_tags($product->details)),45,' ...') }}
					</div>
					<div class="price-buy">
						<div class="price">${{ $product->price }}</div><a class="buy fa fa-cart-plus fa-2x" href="{{ $product->options->count() ? url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') : url('/cart/add/'.$product->id.'/?qty=1') }}"></a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

</div>
@stop
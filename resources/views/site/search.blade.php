@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
@stop

@section('content')

<div class="container index search">
<div class="section">
	<div class="section-name row">Search Result for : {{ $query }}</div>
	@if($products->count() == 0)
		<div class="no-result">
			<p>Sorry, no products found! Here are some search tips :</p>
			<ul>
				<li>Check the spelling</li>
				<li>Try more unspecific terms</li>
				<li>Use synonyms</li>
				<li>Start a new search</li>
			</ul>
		</div>
	@endif
	@if($products->count())
	<div class="sort">sort by : <a href="{{ url(Request::url().'?q='.$query.'&sort=newest') }}">NEWEST</a><span class="seperator"> | </span>
		<a href="{{ url(Request::url().'?q='.$query.'&sort=highest') }}">Highest Price</a><span class="seperator"> | </span>
		<a href="{{ url(Request::url().'?q='.$query.'&sort=lowest') }}">Lowest Price</a>
	</div>
	@endif
	<div class="row">
		<div class="items">
			@foreach($products as $product)
				<div class="item col-md-3 col-sm-4 col-xs-12 clickable" data-href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">
					<div class="photo"><img src="{{ $product->thumbnail }}">{!! $product->created_at >= Carbon\Carbon::now()->subweek() ? '<span class="new-product">NEW</span>' : '' !!}</div>
					<div class="name">{{ str_limit($product->name,45,' ...') }}</div>
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
{!! $products->appends([
	'sort' => Request::get('sort'),
	'q' => $query
	])->render() !!}
</div>

@stop
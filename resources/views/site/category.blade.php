@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
@stop

@section('content')
<div class="container-fluid index category">
<div class="row">
<div class="col-md-3">
	<div class="other-categories">
		<ul>
			<li class="other-section-name">{{ $category->section->name }}</li>
			@foreach($category->section->categories as $cat)
				<li><a href="{{ url('/category/'.$cat->id.'/show') }}">{{ $cat->name }}</a></li>
			@endforeach
		</ul>
	</div>
</div>
<div class="col-md-9">
	<div class="section">
		<div class="section-name row">{{ $category->name }}</div>
		<div class="sort">sort by : <a href="{{ url(Request::url().'?sort=newest') }}">Newest</a><span class="seperator"> | </span>
		<a href="{{ url(Request::url().'?sort=highest') }}">Highest Price</a><span class="seperator"> | </span>
		<a href="{{ url(Request::url().'?sort=lowest') }}">Lowest Price</a>
		</div>
		<div class="row">
			<div class="items">
				@foreach($products as $product)
					<div class="item col-md-3 col-sm-4 col-xs-12 clickable" data-href="{{ url('/product/'.$product->id.'-'.Str::slug($product->name).'/show') }}">
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
	{!! $products->appends(['sort' => Request::get('sort')])->render() !!}
</div>
</div>
</div>
@stop
@extends('site.template')

@section('navigation')
	@include('site.navigation',[$sections,$cart,$total])
@stop

@section('content')
<div class="container-fluid custom-page">
	{!! $page->page_source !!}
</div>
@stop
@extends('admin.template')


@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
	<div class="dashboard container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Monthly Income Report : {{ $total }} $</h3>
				<canvas id="payment-report" width="950" height="470"></canvas>
			</div>
		</div>
	</div>
@stop

@section('footer')
<script src="{{ url('/js/Chart.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.sidebar #dashboard').addClass('active-section');
		var ctx = document.getElementById('payment-report').getContext('2d');
		var labels = {!! json_encode($timestamps) !!};
		var data = {{ json_encode($totals) }};
		var chart = {
			labels : labels,
			datasets : [{
				data : data,
				fillColor : "#80B3D1",
				strokeColor : "#25343e",
				pointColor : "#25343e"
			}]
		};
		new Chart(ctx).Line(chart);
	});
</script>
@stop
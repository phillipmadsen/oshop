<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="/css/sweetalert.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="navigation">
	@yield('navigation')
</div>

<div class="content">
	@if(Session::has('flash_message'))
		<div class="flash-message {{ Session::has('flash-warning') ? 'warning-message' : '' }}">
			{{ session('flash_message') }}
		</div>
	@endif
	@if(Session::has('alert-error'))
		<div class="alert-error"></div>
	@endif
	@if(Session::has('alert-success'))
		<div class="alert-success"></div>
	@endif
	@yield('content')
</div>

<div class="social">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<span id="sub-msg">Subscribe to Newsletter : </span> <input type="text" id="sub-input" name="subscribe" placeholder="Enter your email address">
			</div>
			<div class="col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-12">
				Join :
				<a href="#" class="fa fa-facebook-square fa-2x" id="facebook"></a>
				<a href="#" class="fa fa-twitter-square fa-2x" id="twitter"></a>
				<a href="#" class="fa fa-instagram fa-2x" id="instagram"></a>
				<a href="#" class="fa fa-google-plus-square fa-2x" id="googleplus"></a>
				<a href="#" class="fa fa-pinterest-square fa-2x" id="pinterest"></a>
			</div>
		</div>
	</div>
</div>

<div class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-sm-4 col-xs-6">
				<ul>
					<li class="Heading">OVERVIEW</li>
					<li><a href="#">About</a></li>
					<li><a href="#">Shipping</a></li>
					<li><a href="#">Returns</a></li>
					<li><a href="#">Terms</a></li>
					<li><a href="#">Privacy</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<ul>
					<li class="Heading">ACCOUNT</li>
					<li><a href="{{ url('/auth/register') }}">Create Account</a></li>
					<li><a href="{{ url('/auth/login') }}">Log In</a></li>
					<li><a href="{{ url('/dashboard') }}">Purchases</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<ul>
					<li class="Heading">OUR STORES</li>
					<li><a href="#">San Francisco, CA</a></li>
					<li><a href="#">Los Angeles, CA</a></li>
					<li><a href="#">Seattle, WA</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<ul>
					<li class="Heading">ADDRESS</li>
					<li>580 California Street</li>
					<li>16 Floor, San Fransisco, CA</li>
					<li></li>
					<li>Phone : 666-666-666</li>
					<li>FAX : 666-666-666</li>
				</ul>
			</div>
		</div>
		<hr>
		<div class="copyright">Copyright © 2015 Developed By <a href="mailto:">Phillip Madsen</a>. All Rights Rserved.</div>
	</div>
</div>

<script src="/js/jquery-2.1.3.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){

		if ($('.alert-error').length) {
			swal({
				title: "Error!",
				text: "{{ Session::get('alert-error') }}",
				type: "error",
				timer: 3000,
				showConfirmButton: false
			});
		};
		if($('.alert-success').length){
			swal({
				title: "Success",
				text: "{{ Session::get('alert-success') }}",
				type: "success",
				timer: 3000,
				showConfirmButton: false
			});
		};
	});
</script>
<script src="/js/script.js"></script>
@yield('footer')
</body>
</html>

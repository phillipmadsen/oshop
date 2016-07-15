<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/admin_dashboard.css">
</head>
<body>
<div class="sidebar">
	@yield('sidebar')
</div>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse" id="navbar-menu">
		<ul class="nav navbar-nav">
			<li><i class="fa fa-bars fa-2x" id="sidebar-toggle"></i></li>
			<li><i class="fa fa-refresh fa-2x" id="refresh"></i></li>
			<li class="clickable" data-href="{{ url('/admin') }}"><i class="fa fa-th-large fa-2x"></i></li>
			<li></li>
		</ul>
		<form class="navbar-form navbar-left" role="search">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Search" id="navbar-search">
				<i class="fa fa-search form-control-feedback"></i>
			</div>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#" >{{ Auth::user()->username }}</a></li>
			<li class="clickable" data-href="{{ url('/admin/messages') }}"><i class="fa fa-envelope fa-2x"></i><span class="badge badge-notify" >{{ \App\Message::whereOpened(0)->count() }}</span></li>
			<li class="clickable" data-href="{{ url('/admin/orders') }}"><i class="fa fa-bell fa-2x"></i><span class="badge badge-notify">{{ \App\Order::whereOpened(0)->count() }}</span></li>
			<li><img src="{{ Auth::user()->userInfo->photo }}" id="profileimg"></li>
			<li class="dropdown navbar-settings">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-cog fa-2x"></i> </a>
				<ul class="dropdown-menu">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
				</ul>
			</li>
			
		</ul>
	</div><!-- /.navbar-collapse -->
	</div>
</nav>

<div class="content">
	@if(Session::has('flash_message'))
		<div class="flash-message {{ Session::has('flash-warning') ? 'warning-message' : '' }}">
			{{ session('flash_message') }}
		</div>
	@endif
	@yield('content')
</div>

<script src="/js/jquery-2.1.3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="/js/bootstrap.min.js"></script>
@yield('footer')
<script src="/js/admin_dashboard.js"></script>
</body>
</html>
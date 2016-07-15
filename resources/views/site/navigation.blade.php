<div class="top-nav">
	<nav class="navbar navbar-inverse" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="/">ECommerce</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse ">
			
			<ul class="nav navbar-nav navbar-right">
				<li id="search" class="animated">
					<form action="{{ url('/search') }}">
						<input type="text" name="q" placeholder="Search Products">
					</form>
				</li>
				<li id="search-toggle">
					<a href="#"><i class="fa fa-search"></i></a>
				</li>
				@if(Auth::user())
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ Auth::user()->userInfo->photo }}" id="profile-img"><i class="fa fa-chevron-down" id="profile-toggle"></i></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
							<li><a href="{{ url('/contact') }}">Contact Us</a></li>
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@else
					<li><div class="register-login"><a href="{{ url('/auth/login') }}">Login</a> \ <a href="{{ url('/auth/register') }}">Register</a></div></li>
				@endif
				<li class="dropdown cart">
					<a href="#" class="dropdown-toggle fa fa-shopping-cart " data-toggle="dropdown"><span id="cart-items">{{ $cart->count() }}</span></b></a>
					<ul class="dropdown-menu">
						@foreach($cart as $item)
						<li>
							<div class="item">{{ $item->product->name }} <span class="price">${{ $item->product->price*$item->amount }}<i class="fa fa-times-circle clickable" id="remove-item" data-href="{{ url('/cart/remove/'.$item->product->id) }}"></i></span> </div>
						</li>
						@endforeach
						<li class="total">
							TOTAL <span class="price">${{ $total }}</span>
							<div id="chekout-btn" class="clickable" data-href="{{ url('/cart') }}">proceed to checkout</div>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
	</div>

	<div class="bottom-nav">
	<nav class="navbar navbar-default" role="navigation">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-bottom-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div id="bottom-search">
			<form action="{{ url('/search') }}">
				<input type="text" name="q" placeholder="Search Products">
			</form>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-bottom-collapse">
			<ul class="nav navbar-nav navbar-left">
				@foreach($sections as $section)
				<li class="section">
					<a href="#" class="cat-toggle dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $section->name }}</a>
					<ul class="categories dropdown-menu">
						@foreach($section->categories as $category)
							<li><a href="{{ url('/category/'.$category->id.'/show') }}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
	</div>
	
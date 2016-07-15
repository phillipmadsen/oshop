<div class="side-header">
	Control Panel
</div>
<div class="side-sections">
	<div id="title">MENU</div>
	<ul>
		<li id="dashboard"><a href="{{ url('/admin') }}"><i class="fa fa-tachometer fa-lg"></i>Dashboard</a></li>
		<li id="messages"><a href="{{ url('/admin/messages') }}"><i class="fa fa-envelope fa-lg"></i>Messages <span id="msg-notofication">{{ \App\Message::whereOpened(0)->count() }}</span> </a></li>
		<li id="products"><a href="{{ url('/admin/products') }}"><i class="fa fa-truck fa-lg"></i>Products</a></li>
		<li id="coupons"><a href="{{ url('/admin/coupons') }}"><i class="fa fa-gift fa-lg"></i>Coupons</a></li>
		<li id="pages"><a href="{{ url('/admin/pages') }}"><i class="fa fa-file-text"></i>Pages Builder</a></li>
		<li id="sections"><a href="{{ url('/admin/sections') }}"><i class="fa fa-puzzle-piece fa-lg"></i>Sections</a></li>
		<li id="categories"><a href="{{ url('/admin/categories') }}"><i class="fa fa-database fa-lg"></i>Categories</a></li>
		<li id="users"><a href="{{ url('/admin/users') }}"><i class="fa fa-users fa-lg"></i>Users</a></li>
		<li id="orders"><a href="{{ url('/admin/orders') }}"><i class="fa fa-shopping-cart fa-lg"></i>Orders <span id="order-notofication">{{ \App\Order::whereOpened(0)->count() }}</span> </a></li>
		<li id="payment"><a href="{{ url('/admin/payment') }}"><i class="fa fa-credit-card fa-lg"></i>Payment</a></li>
	</ul>
</div>
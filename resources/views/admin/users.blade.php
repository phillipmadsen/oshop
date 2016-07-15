@extends('admin.template')

@section('sidebar')
	@include('admin.sidebar')
@stop

@section('content')
<div class="users">
<a class="fa fa-plus add-btn" href="{{ url('/admin/user/create') }}">Add User</a>
<table class="table">
	<tr id="table-header">
		<td>#</td>
		<td>Type</td>
		<td>Username</td>
		<td>Firstname</td>
		<td>Lastname</td>
		<td>Email</td>
		<td>Phone</td>
		<td>Country</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ $user->isAdmin == 1 ? 'Admin' : 'User' }}</td>
		<td>{{ $user->username }}</td>
		<td>{{ $user->userInfo->firstname }}</td>
		<td>{{ $user->userInfo->lastname }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->userInfo->phone }}</td>
		<td>{{ $user->userInfo->country }}</td>
		<td><a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="fa fa-pencil-square-o"></a></td>
    	<td><a href="{{ url('/user/'.$user->id.'/delete') }}" class="fa fa-times {{ Auth::user()->id == $user->id ? 'not-active' : '' }}"></a></td>
    </tr>
	@endforeach
</table>
{!! $users->render() !!}
</div>
@stop

@section('footer')
	<script>
	$(document).ready(function(){
		$('.sidebar #users').addClass('active-section');
	});
	</script>
@stop
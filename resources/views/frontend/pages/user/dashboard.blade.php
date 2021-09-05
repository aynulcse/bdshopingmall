@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-3 text-center " style="min-height: 350px;">
		  <div class="card card-body bg-light">
		  	<img src="{{asset($user->avatar)}}" height="120" width="120" style="margin-left: 22% ;border-radius:100px; margin-bottom: 20px;margin-top: 20px;" alt="Images" >
		  	<div>
  				 <h3>{{ Auth::user()->first_name ." ". Auth::user()->last_name }}</h3>
  				 <i class="fa fa-circle text-success"></i> Online 
  			</div>
		  	<div class="list-group mt-5">
			 	<a href="{{route('user.dashboard')}}" class="list-group-item {{Route::is('user.dashboard') ? 'active' :''}}" >Dashboard</a>
			 	<a href="{{route('user.profile')}}" class="list-group-item  {{Route::is('user.profile') ? 'active' :''}}" >Update Profile</a>
			 	<a href="{{route('user.order.history')}}" class="list-group-item  {{Route::is('user.order.history') ? 'active' :''}}" >Order History</a>
			 	<a href="{{route('carts')}}" class="list-group-item {{Route::is('carts') ? 'active' :''}}" >Cart</a>
			 	
			 </div>
		  </div>
		</div>
		<div class="col-md-9">
		  <div class="card">
		  	<div class="card-header">
		 	<h2>Welcome to {{$user->first_name}} {{$user->last_name}}</h2>
			 </div>
			 <div class="card-body">
			 	<a class="btn btn-lg btn-primary" href="{{route('user.profile')}}">Update_profile </a>
			 </div>
		  </div>
		</div>
	</div>
</div>
@endsection
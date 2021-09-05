@extends('frontend.layouts.master')

@section('content')
<div class="container mt-3">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li class=""><a class="mt-0" href="{{ route('index') }}">Home</a></li>
		  <li class="active">Products</li>
		</ol>
	</div><!--/breadcrums-->
	<div class="row">
		<div class="col-md-3">
			<div class="left-sidebar">
				@include('frontend.partials.left-side')
			</div>
		</div>
	<div class="col-md-9">
		@include('frontend.pages.product.partials.all_products')
	</div>
  </div>
</div>



@endsection
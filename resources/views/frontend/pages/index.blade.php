
@extends('frontend.layouts.master')

@section('content')
<div id="loader"></div>
@include('frontend.partials.slider')

<div class="container mt-5">
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

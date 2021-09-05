<head>
	<title>Ecomerce</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{csrf_token()}}">
<!-- style start -->
	@include('frontend.partials.styles')
<!-- styles end -->
</head>
<body>
<div class="waraper">
<!-- start nav -->
	@include('frontend.partials.nav')
	@include('backend.partials.message')
<!-- end of nav -->

<!-- content start -->

 @yield('content')
	
<!-- content end -->

</div>
<!-- fotter -->
	@include('frontend.partials.fotter')	
<!-- fotter end -->

<!-- script start -->
	@include('frontend.partials.script')
	@yield('script')
<!-- script end -->
</body>
</html>
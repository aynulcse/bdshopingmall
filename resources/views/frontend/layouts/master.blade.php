<head>
	<title>Ecomerce</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{csrf_token()}}">
<!-- style start -->
	@include('Frontend.partials.styles')
<!-- styles end -->
</head>
<body>
<div class="waraper">
<!-- start nav -->
	@include('Frontend.partials.nav')
	@include('backend.partials.message')
<!-- end of nav -->

<!-- content start -->

 @yield('content')
	
<!-- content end -->

</div>
<!-- fotter -->
	@include('Frontend.partials.fotter')	
<!-- fotter end -->

<!-- script start -->
	@include('Frontend.partials.script')
	@yield('script')
<!-- script end -->
</body>
</html>
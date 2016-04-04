<!doctype html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
	@yield('styles')
</head>
<body>
    @include('includes.header')
	<div class="main">
	    @yield('content')
	</div>
</body>
</html>
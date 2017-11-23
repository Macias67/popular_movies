<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>App Movies</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
		<script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ asset('bower_components/angular-animate/angular-animate.js') }}"></script>
	</head>
	<body>
		<div class="container">
			<ul class="nav nav-tabs">
				<li id="pop" role="presentation"><a href="{{ url('/popular_movies') }}">Populares</a></li>
				<li id="fav" role="presentation"><a href="{{ url('/myfavorites') }}">Favorites</a></li>
			</ul>
			@yield('populares')
			@yield('favoritas')
		</div>
	</body>
</html>
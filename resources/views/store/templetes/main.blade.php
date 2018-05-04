<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<title>{{$title or 'Store PagSeguro'}}</title>
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- DENTRO DO PASTA PUBLIC -->
		<link rel="stylesheet" href="{{url('css/style.css')}}">
		<link rel="stylesheet" href="{{url('css/reset.css')}}">
	</head>
	<body>

		@include('store.templetes.menu')

		<div class="container">

			@yield('content')
			  
		</div>
		
		
		@stack('scripts')

	</body>
</html>

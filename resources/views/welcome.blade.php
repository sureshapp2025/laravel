<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Tracksen</title>

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

	<!-- Scripts -->
		@vite(['resources/sass/app.scss', 'resources/js/app.js'])
	</head>
	<body class="bg-light">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="/">
					<x-application-logo class="d-inline-block align-text-top" style="height: 30px; width: auto; filter: invert(1);"/>
					Tracksen
				</a>
				<div
					class="ms-auto">
					@if (Route::has('login'))
						@auth
							<a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
						@else
							<a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Log in</a>
							@if (Route::has('register'))
								<a href="{{ route('register') }}" class="btn btn-light btn-sm">Register</a>
							@endif
						@endauth
					@endif
				</div>
			</div>
		</nav>

		<main class="container py-5 mt-5">
			<div class="row justify-content-center">
				<div class="col-md-10 text-center">
					<div class="mb-4">
						<img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
					</div>
					<h1 class="display-4 fw-bold">Laravel Product Manager</h1>
					<p class="lead mb-5 text-secondary">A simple, powerful, and modern product management system built with Laravel and Bootstrap.</p>

					<div class="row g-4 text-start">
						<div class="col-md-4">
							<div class="card h-100 shadow-sm border-0">
								<div class="card-body p-4">
									<h3 class="h5 fw-bold">
										<i class="bi bi-shield-check text-primary me-2"></i>
										RBAC</h3>
									<p class="text-secondary small">Role-Based Access Control to manage users, admins, and super admins effortlessly.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card h-100 shadow-sm border-0">
								<div class="card-body p-4">
									<h3 class="h5 fw-bold">
										<i class="bi bi-box-seam text-primary me-2"></i>
										Inventory</h3>
									<p class="text-secondary small">Comprehensive product tracking and management with detailed views and reports.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card h-100 shadow-sm border-0">
								<div class="card-body p-4">
									<h3 class="h5 fw-bold">
										<i class="bi bi-lightning text-primary me-2"></i>
										Fast</h3>
									<p class="text-secondary small">Built on Laravel 11 and Vite for the fastest development and production experience.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<footer class="text-center py-5 text-secondary">
			<div class="container">
				<p>Laravel v
					{{ Illuminate\Foundation\Application::VERSION }}
					(PHP v{{ PHP_VERSION }})</p>
			</div>
		</footer>
	</body>
</html>


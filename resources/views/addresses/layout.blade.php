<x-app-layout>
	<x-slot name="header">
		<h2 class="h4 font-weight-bold mb-0 text-dark">
			Addresses
		</h2>

	</x-slot>
	<div class="d-flex justify-content-end mb-2">
		<a href="{{ route('addresses.index') }}" class="btn btn-secondary">
			<i class="bi bi-arrow-left me-1"></i>
			Back
		</a>
	</div>

	<div class="">
		<!-- Notification Messages -->
		@if ($message = Session::get('success'))
                <div class="alert alert-success mb-4 mt-3 mx-3" role="alert"> <p class="mb-0">{{ $message }}</p>
            </div>
        @endif
								        
								        @yield('content')
	</div>
</x-app-layout>


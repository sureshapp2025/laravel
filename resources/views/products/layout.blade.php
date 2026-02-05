<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0 text-dark">
            Products
        </h2>
    </x-slot>

    <div class="">
        <!-- Notification Messages -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success mb-4" role="alert">
            <p class="mb-0">{{ $message }}</p>
        </div>
        @endif
        
        @yield('content')
    </div>
</x-app-layout>

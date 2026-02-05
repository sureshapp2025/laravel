<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0 text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="card shadow-sm">
            <div class="card-body">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>

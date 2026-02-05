<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light py-3 px-3">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo class="w-25 h-25 text-secondary" />
                </a>
            </div>

            <div class="w-100 card shadow-sm p-3 p-md-4 overflow-hidden rounded" style="max-width: 450px;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

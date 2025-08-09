<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Bottube' }}</title>

    <!-- Remix Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Loader CSS -->
    <style>
        #loader {
            transition: opacity 0.5s ease;
        }
    </style>

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    @stack('custom-css')

    <!-- Alpine.js Intersect Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-white text-black">
  

    @auth
        @livewire('partials.navbar')
    @endauth

    {{ $slot }}

    <!-- Livewire Scripts -->
    @livewireScripts

    

    @stack('scripts')
@livewire('floating1')
</body>
</html>

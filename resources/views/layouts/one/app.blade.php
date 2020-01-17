<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @livewireAssets
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100 antialiased font-sans text-gray-600">
    <main class="flex w-100 flex-col min-h-screen" id="app">
        <div class="main flex-1">
            @yield('content')
        </div>
    </main>
</body>

</html>
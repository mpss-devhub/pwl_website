<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PaywithLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/main/css/home.css') }}">
    <script src="{{ asset('common/main/js/home.js') }}"></script>
</head>

<body class="">
    @include('layouts.alert')
    <div class="relative overflow-hidden min-h-screen">
        <div class="relative z-10">
            @include('layouts.frontnav')
        </div>
        @yield('main')
    </div>
    @include('layouts.footer')
</body>

</html>

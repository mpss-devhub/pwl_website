<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merchant | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('common/components/js/merchant.js') }}"></script>
    <script src="{{ asset('common/components/js/toggle.js') }}"></script>
    <script src="{{ asset('common/main/js/loading.js') }}"></script>
</head>

<body>
    @include('Merchant.components.nav')
    @include('layouts.alert')
    @yield('merchant_content')

</body>

</html>

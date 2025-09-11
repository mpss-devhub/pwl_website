<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pay With Link</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('common/components/js/admin.js') }}"></script>
    <script src="{{ asset('common/components/js/screenshoot.js') }}"></script>
    <script src="{{ asset('common/components/js/access.js') }}"></script>
    <script src="{{ asset('common/components/js/toggle.js') }}"></script>
    <script src="{{ asset('common/components/js/validate.js') }}"></script>
    <script src="{{ asset('common/main/js/loading.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body>

    @include('Admin.components.nav')
    @include('layouts.alert')
    @yield('admin_content')
</body>

</html>

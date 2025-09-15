<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/checkout/style.css') }}">
    <script src="{{ asset('common/checkout/js/checkout.js') }}"></script>
    <script src="{{ asset('common/checkout/js/prevent.js') }}"></script>


</head>

<body class="bg-white flex justify-center items-center  p-4">
    <div
        class="w-full max-w-[450px] bg-[#F1F2F785] shadow-lg shadow-[#B9C4FC] rounded-xl p-4 sm:p-6 space-y-4 sm:space-y-6 border border-[#C0CAFC]">
        @yield('checkout')


        <!-- Footer -->
        <div class="text-[10px] sm:text-[11px] text-gray-700 space-y-1">
            <p class=" text-gray-700 text-center">
                 Power By <a href="https://www.octoverse.com.mm/"
                    class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>

</body>

</html>

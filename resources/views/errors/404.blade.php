<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/checkout/style.css') }}">
    <script src="{{ asset('common/checkout/js/checkout.js') }}"></script>
    <script src="{{ asset('common/checkout/js/prevent.js') }}"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 sm:px-0" style="font-family: 'Libre Baskerville'">

    <div class="bg-white shadow-xl rounded-xl px-6 py-8 sm:p-10 w-full max-w-md text-center border border-red-50 relative">

        {{-- Logo Top Right --}}
        <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
            <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-16 sm:w-20 md:w-24" alt="Logo">
        </div>

        {{-- Warning Content --}}
        <div class="mt-8 sm:mt-12">
            <div class="text-red-600 text-3xl sm:text-4xl mb-2">⚠️</div>
            <span class="text-red-500">404</span>
            <p class="text-base sm:text-sm "> Oppps Something wents wrongs</p>
            <p class="mt-2 text-gray-600 text-xs sm:text-sm">Please reopen the Links for transaction status.</p>
        </div>

        <hr class="my-6 border-gray-300" />

        <div class="text-xs text-gray-700 space-y-1">
            <p class="text-center">
                 Powered by
                <a href="https://www.octoverse.com.mm/" class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>

</body>

</html>

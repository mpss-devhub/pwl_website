<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Link Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h2 class="text-base sm:text-lg">This payment link has <span class="text-red-500">expired</span></h2>
            <p class="mt-3 text-gray-600 text-xs sm:text-sm">Please contact the merchant to get a new one.</p>
        </div>

        <hr class="my-6 border-gray-300" />

        <div class="text-xs text-gray-700 space-y-1">
            <p class="text-center">
                <i class="fa-solid fa-bolt-lightning"></i> Powered by
                <a href="https://www.octoverse.com.mm/" class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>

</body>

</html>

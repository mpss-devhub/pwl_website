<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Fail</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/checkout/style.css') }}">
    <script src="{{ asset('common/checkout/js/prevent.js') }}"></script>
</head>

<body class="p-4" >
    <div id="exportArea"
        class="w-full max-w-[450px] bg-[#F1F2F785] shadow-lg shadow-[#B9C4FC] rounded-xl p-4 sm:p-6 space-y-4 sm:space-y-6 border border-[#C0CAFC]">
        <!-- Logo -->
        <div class="flex justify-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full flex items-center justify-center">
                <img src="{{ $merchant['merchant_logo'] }}" alt="Merchant Logo"
                    class="rounded-full w-full h-full object-cover" />
            </div>
        </div>

        <div class="text-[11px] sm:text-[13px] text-gray-600 space-y-1 sm:space-y-2 px-2">
            <p class="truncate">Merchant Email: {{ $merchant['merchant_Cemail'] }}</p>
            <p class="truncate">Merchant Address: {{ $merchant['merchant_address'] }}</p>
        </div>

        <!-- Merchant Info -->
        <div class="border border-[#bdc9fe] rounded-lg p-4 sm:p-6 shadow bg-[#f9faff]"
            style="font-family: 'Libre Baskerville'">
            @if ($tnx['payment_status'] == 'SUCCESS')
                <div class="flex items-center justify-center space-x-2">
                    <p class="text-center text-gray-700 font-medium">Payment Success</p>
                    <i class="fa-solid fa-circle-check text-green-500 text-md"></i>
                </div>
            @else
                <div class="flex items-center justify-center space-x-2">
                    <p class="text-center text-gray-700 font-semibold text-sm">Payment Fail</p>

                    <i class="fa-solid fa-circle-exclamation text-red-500 text-md"></i>
                </div>
            @endif
            <div class="text-[13px] mt-3 text-gray-700">
                <!-- Merchant Info -->
                <div class="space-y-1">
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Merchant Name</span>
                        <span class="text-center">:</span>
                        <span class="font-medium truncate">{{ $merchant['merchant_name'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Customer Name</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['payment_user_name'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Amount</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['req_amount'] }} {{ $tnx['currencyCode'] }}</span>
                    </div>
                </div>

                <hr class="border-t border-dotted border-gray-400 my-3 sm:my-4">

                <div class="space-y-1">
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Invoice</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['tranref_no'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Trans No</span>
                        <span class="text-center">:</span>
                        <span class="font-medium truncate">{{ $tnx['bank_tranref_no']  !== null ?  $tnx['bank_tranref_no'] : 'N/A' }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Amount</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['req_amount'] }} {{ $tnx['currencyCode'] }}</span>
                    </div>
                </div>
                <div class="flex justify-start mt-6 mx-6">
                    <img src="{{ Storage::url('common/f.png') }}" class="w-16 h-16 sm:w-24 sm:h-24 "
                        alt="Success Image">
                </div>
            </div>
        </div>

        <div class="text-xs text-gray-700 text-center">
            <p>
                Power By <a href="https://www.octoverse.com.mm/" class="text-[#8a9adb]">octoverse.com.mm</a>
            </p>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<style>
    body {
        font-family: "Poppins", sans-serif;
        min-height: 96vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
</style>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="bg-white flex justify-center items-center  p-4">
    <div
        class="w-full max-w-[450px] bg-[#F1F2F785] shadow-lg shadow-[#B9C4FC] rounded-xl p-4 space-y-4 border border-[#C0CAFC]">
        <!-- Logo -->
        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full flex items-center justify-center text-sm font-semibold">
                <img src="{{ $merchant->merchant_logo }}" alt="Merchant Logo" style="border-radius: 100px" />
            </div>
        </div>
        <div class="text-[13px] ml-2 text-gray-600 space-y-2">
            <p>Merchant Email : {{ $merchant->merchant_Cemail }}</p>
            <p>Merchant Address : {{ $merchant->merchant_address }}</p>
        </div>
        <!-- Merchant Info -->
        <div class="border border-[#bdc9fe] rounded-lg p-6 shadow  bg-[#f9faff]">
            <!-- Invoice Header -->
            <p class="text-center text-[#3C425D] mx-28 font-semibold text-base" style="font-family: 'Poppins'">INVOICE
            </p>

            <div class="text-sm mt-4 text-gray-700" style="font-family: 'Libre Baskerville'">
                <!-- Merchant Info -->
                <div class="space-y-2">
                    <div class="grid grid-cols-3">
                        <span>To</span>
                        <span class="text-center">:</span>
                        <span class="font-medium">{{ $link->link_name }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span>Invoice No</span>
                        <span class="text-center">:</span>
                        <span>{{ $link->link_invoiceNo }}</span>
                    </div>

                    <div class="grid grid-cols-3">
                        <span>Amount</span>
                        <span class="text-center">:</span>
                        <span>{{ $link->link_amount }} {{ $link->link_currency }}</span>
                    </div>
                </div>
                <hr class="border-t border-dotted border-gray-400 my-4">

                <!-- Payment Info -->
                <div class=" w-full max-w-[400px] sm:max-w-[350px] h-auto min-h-[250px] mx-auto">

                    <!-- Payment Methods Tabs -->
                    <div class="text-center text-gray-800">
                        <p class="mb-3 text-md" style="font-family: 'Libre Baskerville'">Payment Method</p>

                        <div class="flex flex-wrap bg-[#EEF1FC] border-b-[#C2CDF1] rounded-md overflow-hidden  "
                            style="font-family: 'Poppins'">

                            <button id="pin-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium  border-b-2 border-transparent rounded-l text-black active-tab"
                                onclick="switchTab('pin')">
                                PIN
                            </button>
                            <button id="qr-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium  border-b-2 border-transparent  text-black"
                                onclick="switchTab('qr')">
                                QR
                            </button>
                            <button id="web-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium  border-b-2 border-transparent  text-black"
                                onclick="switchTab('web')">
                                WEB
                            </button>
                            <button id="card-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium  border-b-2 border-transparent rounded-r text-black"
                                onclick="switchTab('card')">
                                CARD
                            </button>
                        </div>

                        <!-- Tab Contents -->
                        <div class="mt-3">
                            <!-- PIN Content -->
                            <div id="pin-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto">
                                <div class="grid grid-cols-4 gap-1 sm:gap-4 mb-4 mt-1">
                                    @foreach ($Ewallet as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-11 h-11 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'Ewallet',
                                                ])
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-600">Enter your PIN to complete payment</p>
                            </div>

                            <!-- QR Content -->
                            <div id="qr-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                    @foreach ($QR as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-11 h-11 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'QR',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-sm text-gray-600">Scan this QR code to pay</p>
                            </div>

                            <!-- WEB Content -->
                            <div id="web-content"
                                class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                    @foreach ($Web as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-11 h-11 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'Web',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <p class="text-sm text-gray-600">You'll be redirected to payment page</p>
                            </div>
                            <div id="card-content"
                                class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">

                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                    @foreach ($L_C as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-11 h-11 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'L_C',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($G_C as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-11 h-11 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'G_C',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-sm text-gray-600">You'll be redirected to payment page</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-xs text-gray-700 space-y-1">

            <p class=" text-gray-700 text-center">
                <i class="fa-solid fa-bolt-lightning"></i> Power By <a href="https://www.octoverse.com.mm/"
                    class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active style from all tabs
            document.querySelectorAll('[id$="-tab"]').forEach(tab => {
                tab.classList.remove('text-blue-500', 'border-blue-500', 'active-tab');
                tab.classList.add('border-transparent');
            });

            // Show selected tab content
            document.getElementById(`${tabName}-content`).classList.remove('hidden');

            // Add active style to selected tab
            const activeTab = document.getElementById(`${tabName}-tab`);
            activeTab.classList.add('text-blue-500', 'border-blue-500', 'active-tab');
            activeTab.classList.remove('border-transparent');
        }

        // Initialize with PIN tab active
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('pin');
        });
    </script>
</body>

</html>

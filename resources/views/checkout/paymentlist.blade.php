<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<style>
    body {
        font-family: "Poppins", sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        min-height: 100vh;
    }
</style>

<body class="bg-white flex justify-center items-center min-h-screen p-4">
    <div class="w-full max-w-[500px] bg-[#F1F2F785] shadow-xl rounded-xl p-4 space-y-4 border border-[#C0CAFC]">
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
        <div class="border border-[#bdc9fe] rounded-lg p-5 shadow space-y-4 bg-[#f9faff]">
            <!-- Invoice Header -->
            <p class="text-center text-gray-700 font-semibold text-base" style="font-family: 'Poppins'">INVOICE</p>

            <div class="space-y-2 text-md text-gray-700" style="font-family: 'Libre Baskerville'">
                <!-- Merchant Info -->
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>To</span>
                        <span class="font-medium">{{ $link->link_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Invoice No</span>
                        <span>{{ $link->link_invoiceNo }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Amount</span>
                        <span>{{ $link->link_amount }} {{ $link->link_currency }}</span>
                    </div>
                </div>
                <hr>
                <!-- Payment Info -->
                <div class="pt-1 w-full max-w-[400px] sm:max-w-[350px] h-auto min-h-[250px] mx-auto">

                    <!-- Payment Methods Tabs -->
                    <div class="text-center text-gray-800">
                        <p class="mb-2 font-medium">Payment Method</p>

                        <div class="flex flex-wrap border border-[#C2CDF1] rounded-md overflow-hidden" style="font-family: 'Poppins'">

                            <button id="pin-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium border-b-2 border-transparent bg-[#C2CDF1] rounded-l text-white active-tab"
                                onclick="switchTab('pin')">
                                PIN
                            </button>
                            <button id="qr-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium border-b-2 border-transparent bg-[#C2CDF1]  text-white"
                                onclick="switchTab('qr')">
                                QR
                            </button>
                            <button id="web-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium border-b-2 border-transparent bg-[#C2CDF1]  text-white"
                                onclick="switchTab('web')">
                                WEB
                            </button>
                            <button id="card-tab"
                                class="flex-1 py-2 px-2 sm:px-4 font-medium border-b-2 border-transparent bg-[#C2CDF1] rounded-r text-white"
                                onclick="switchTab('card')">
                                CARD
                            </button>
                        </div>

                        <!-- Tab Contents -->
                        <div class="mt-4">
                            <!-- PIN Content -->
                            <div id="pin-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4">
                                    @foreach ($Ewallet as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            @include('checkout.floading', [
                                                'item' => $item,
                                                'type' => 'Ewallet',
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-600">Enter your PIN to complete payment</p>
                            </div>

                            <!-- QR Content -->
                            <div id="qr-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4">
                                    @foreach ($QR as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            @include('checkout.floading', [
                                                'item' => $item,
                                                'type' => 'QR',
                                            ])
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-sm text-gray-600">Scan this QR code to pay</p>
                            </div>

                            <!-- WEB Content -->
                            <div id="web-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4">
                                    @foreach ($Web as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            @include('checkout.floading', [
                                                'item' => $item,
                                                'type' => 'Web',
                                            ])
                                        </div>
                                    @endforeach

                                </div>

                                <p class="text-sm text-gray-600">You'll be redirected to payment page</p>
                            </div>
                            <div id="card-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">

                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4">
                                    @foreach ($L_C as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode"
                                                value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            @include('checkout.floading', [
                                                'item' => $item,
                                                'type' => 'L_C',
                                            ])
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
                                                    class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            @include('checkout.floading', [
                                                'item' => $item,
                                                'type' => 'G_C',
                                            ])
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

        <div class="text-sm text-gray-700 space-y-1">

            <p class="text-sm text-gray-700 text-center">
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

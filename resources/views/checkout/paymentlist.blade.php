@extends('checkout.layout.index')
@section('checkout')

    <!-- Logo -->
    <div class="flex justify-center">
        <div class="w-24 h-24 rounded-full flex items-center justify-center text-sm font-semibold">
            <img src="{{ $merchant->merchant_logo }}" alt="Merchant Logo" style="border-radius: 100px" />
        </div>
    </div>
    <div class=" ml-2 text-gray-600 space-y-2">
        <p class="text-[11px]">Merchant Email : {{ $merchant->merchant_Cemail }}</p>
        <p class="text-[11px]">Merchant Address : {{ $merchant->merchant_address }}</p>
    </div>
    <!-- Merchant Info -->
    <div class="border border-[#bdc9fe] rounded-lg px-6 py-2 shadow  bg-[#f9faff] ">
        <!-- Invoice Header -->
        <p class="text-center mt-3 text-[#3C425D] mx-28 font-semibold text-sm" style="font-family: 'Poppins'">INVOICE
        </p>

        <div class="text-[13px] mt-4 text-gray-700" style="font-family: 'Libre Baskerville'">
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
                <div class="text-center text-gray-800 ">
                    <p class="mb-3 text-md" style="font-family: 'Libre Baskerville'">Payment Method</p>

                    <div class="flex flex-wrap bg-[#EEF1FC] border-b-[#C2CDF1] rounded-md overflow-hidden  "
                        style="font-family: 'Poppins'">

                        @if ($link->link_currency == 'MMK')
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
                        @endif
                        <button id="card-tab"
                            class="flex-1 py-2 px-2 sm:px-4 font-medium  border-b-2 border-transparent rounded-r text-black {{ $link->link_currency !== 'MMK' ? 'text-start' : '' }}"
                            onclick="switchTab('card')">
                            Card
                        </button>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let defaultTab = "{{ $link->link_currency !== 'MMK' ? 'card' : 'pin' }}";
                            switchTab(defaultTab);
                        });
                    </script>
                    <!-- Tab Contents -->
                    <div class="mt-3">
                        @if ($link->link_currency == 'MMK')
                            <!-- PIN Content -->
                            <div id="pin-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto">
                                <div class="grid grid-cols-4 gap-1 sm:gap-4 mb-4 mt-1">
                                    @foreach ($Ewallet as $item)
                                        @php
                                            $restricted = in_array($item['paymentCode'], [
                                                'CBPAY_PIN',
                                                'KBZPAY_PWA',
                                                'ABANKPAY_PIN',
                                            ]);
                                        @endphp

                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }" class="{{ $restricted ? 'block sm:hidden' : '' }}">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">

                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-10 h-10 object-cover rounded-lg hover:scale-110 transition duration-200">
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
                                <p class="text-[13px] text-gray-600">Enter your PIN to complete payment</p>
                            </div>


                            <!-- QR Content -->
                            <div id="qr-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                    @foreach ($QR as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-10 h-10 object-cover rounded-lg hover:scale-110 transition duration-200">
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

                                <p class="text-[13px] text-gray-600">Scan this QR code to pay</p>
                            </div>

                            <!-- WEB Content -->
                            <div id="web-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">
                                <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                    @foreach ($Web as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-10 h-10 object-cover rounded-lg hover:scale-110 transition duration-200">
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

                                <p class="text-[13px] text-gray-600">You'll be redirected to payment page</p>
                            </div>
                        @endif
                        <div id="card-content" class="tab-content min-h-[180px] max-h-[250px] overflow-y-auto hidden">

                            <div class="grid grid-cols-4 gap-2 sm:gap-4 mb-4 mt-1">
                                @if ($link->link_currency == 'MMK')
                                    @foreach ($L_C as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-10 h-10 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'L_C',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($link->link_currency !== 'MMK')
                                    @foreach ($G_C as $item)
                                        <div x-data="{ open: false, payment: {}, tnx_number: '' }">
                                            <input type="hidden" name="paymentCode" value="{{ $item['paymentCode'] }}">
                                            <input type="hidden" name="link_id" value="{{ $link->id }}">
                                            <input type="hidden" name="payment_logo" value="{{ $item['logo'] }}">
                                            <button type="button" class="focus:outline-none"
                                                @click="open = true; payment = {{ json_encode($item) }};">
                                                <img src="{{ $item['logo'] }}" alt="Payment Option"
                                                    class="w-10 h-10 object-cover rounded-lg hover:scale-110 transition duration-200">
                                            </button>

                                            <div x-show="open" x-cloak>
                                                @include('checkout.floading', [
                                                    'item' => $item,
                                                    'type' => 'G_C',
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <p class="text-[13px] text-gray-600">You'll be redirected to payment page</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

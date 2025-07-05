<script src="https://unpkg.com/alpinejs" defer></script>

<div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" x-cloak>
    <div class="bg-[#fbfcfffd] rounded-xl shadow-xl w-full max-w-md p-4 sm:p-6 relative border border-[#BFC7EE] mx-auto">
        <!-- Close Button -->
        <div class="flex justify-between items-center h-auto sm:h-[3vw]">
            <div>
                <button @click="open = false" class="text-gray-600 hover:text-red-500 text-2xl">
                    &times;
                </button>
            </div>

            <div>
                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="Logo" class="w-16 h-16 sm:w-24 sm:h-24 object-contain">
            </div>
        </div>

        <form action="{{ route('Pwl') }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
            @csrf

            <div class="py-4 sm:py-5">
                <!-- Hidden Data -->
                <input type="hidden" name="paymentCode" :value="payment.paymentCode">
                <input type="hidden" name="link_id" value="{{ $link->id }}">
                <input type="hidden" name="payment_logo" :value="payment.logo">
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Input Field -->
                <div class="mb-4">
                    <div class="">
                        <img src="{{ $item['logo'] }}" alt="" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2 rounded">
                    </div>
                    <br>
                    <div class="text-sm sm:text-md text-gray-700 space-y-2 text-start mx-2 sm:mx-5">
                        <div class="grid grid-cols-3 px-2 sm:px-5">
                            <span class="truncate">To</span>
                            <span class="text-center">:</span>
                            <span class="font-medium truncate">{{ $link->link_name }}</span>
                        </div>
                        <div class="grid grid-cols-3 px-2 sm:px-5">
                            <span class="truncate">Merchant</span>
                            <span class="text-center">:</span>
                            <span class="font-medium truncate">{{ $merchant->merchant_name }}</span>
                        </div>
                        <div class="grid grid-cols-3 px-2 sm:px-5">
                            <span class="truncate">Invoice No</span>
                            <span class="text-center">:</span>
                            <span class="font-medium truncate">{{ $link->link_invoiceNo }}</span>
                        </div>
                        <div class="grid grid-cols-3 px-2 sm:px-5">
                            <span class="truncate">Amount</span>
                            <span class="text-center">:</span>
                            <span class="font-medium truncate">{{ $link->link_amount }}</span>
                        </div>
                    </div>

                    <hr class="my-4 mx-2 sm:mx-10">

                    @if ($type === 'Ewallet' || $type === 'QR' || $type === 'Web')
                        <label for="tnx_phonenumber" class="text-sm text-gray-700"> Phone Number </label>
                        <input required type="text" name="tnx_phonenumber" x-model="tnx_phonenumber"
                            class="w-full max-w-xs sm:w-80 mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-pink-400"
                            placeholder="Enter {{ $item['paymentName'] }} Phone Number">
                    @else
                        @if ($type === 'L_C')
                            <div class="space-y-4 max-w-xs sm:max-w-md mx-auto">
                                <label for="tnx_phonenumber" class="block text-sm font-medium text-gray-700">
                                    {{ $item['paymentName'] }} Card Info
                                </label>

                                <input required type="text" name="tnx_phonenumber" x-model="tnx_phonenumber"
                                    placeholder="Enter Phone Number"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <input required type="text" name="cardNumber" x-model="cardNumber"
                                    placeholder="Enter Card Number"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <div class="flex justify-center">
                                    <div class="flex space-x-2 sm:space-x-4">
                                        <input required type="number" name="expiryMonth" x-model="expiryMonth" placeholder="MM"
                                            class="w-20 sm:w-24 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                        <input required type="number" name="expiryYear" x-model="expiryYear" placeholder="YYYY"
                                            class="w-24 sm:w-28 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-4 max-w-xs sm:max-w-md mx-auto">
                                <label for="cardNumber" class="block text-sm font-medium text-gray-700">
                                    {{ $item['paymentName'] }} Card Info
                                </label>

                                <input required type="text" name="cardNumber" x-model="cardNumber"
                                    placeholder="Enter Card Number"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <input required type="text" name="securityCode" x-model="securityCode"
                                    placeholder="Enter Security Code"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <div class="flex justify-center">
                                    <div class="flex space-x-2 sm:space-x-4">
                                        <input required type="text" name="expiryMonth" x-model="expiryMonth" placeholder="MM"
                                            class="w-20 sm:w-24 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                        <input required type="text" name="expiryYear" x-model="expiryYear" placeholder="YYYY"
                                            class="w-24 sm:w-28 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" :disabled="loading"
                    class="w-50 sm:w-50 shadow-lg text-sm bg-[#F13D78] text-white py-2 px-3 rounded-lg hover:bg-[#ef6593] transition flex items-center justify-center space-x-2"
                    style="font-family: 'Poppins'">
                    <template x-if="!loading">
                        <span>Submit Payment</span>
                    </template>
                    <template x-if="loading">
                        <span>
                            <i class="fas fa-spinner fa-spin mr-1"></i> Processing...
                        </span>
                    </template>
                </button>
            </div>
        </form>
    </div>
</div>

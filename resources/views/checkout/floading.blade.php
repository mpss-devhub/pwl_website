<script src="https://unpkg.com/alpinejs" defer></script>

<div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    x-cloak>
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
        <!-- Close Button -->
        <div class="">
            <button @click="open = false"
                class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-2xl">&times;</button>

            <div class="flex justify-center ">
                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="Logo" class="w-28 h-28 object-contain">

            </div>
        </div>


        <form action="{{ route('Pwl') }}" method="POST" class=" ">
            @csrf

            <div class="border shadow-sm py-5 rounded-lg">
                <!-- Hidden Data -->
                <input type="hidden" name="paymentCode" :value="payment.paymentCode">
                <input type="hidden" name="link_id" value="{{ $link->id }}">
                <input type="hidden" name="payment_logo" :value="payment.logo">
                <input type="hidden" name="type" value="{{ $type }}">
                <!-- Input Field -->
                <div class="mb-4">
                    <div class="">
                        <img src="{{ $item['logo'] }}" alt="" class="w-16 h-16 mx-auto mb-2 rounded">
                    </div>
                    <hr class="mx-10 my-2">
                    <div class="text-sm text-gray-700 space-y-1 text-start mx-5">
                        <p><strong>Merchant Name:</strong> {{ $merchant->merchant_name }}</p>
                        <p><strong>Invoice No:</strong> {{ $link->link_invoiceNo }}</p>
                        <p><strong>To:</strong> {{ $link->link_name }}</p>
                        <p><strong>Amount:</strong> {{ $link->link_amount }} </p>
                    </div>
                    <hr class="my-4 mx-10">
                    @if ($type === 'Ewallet' || $type === 'QR' || $type === 'Web')
                        <label for="tnx_phonenumber" class="text-sm text-gray-700"> Phone Number </label>
                        <input type="text" name="tnx_phonenumber" x-model="tnx_phonenumber"
                            class="w-80 mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-pink-400"
                            placeholder="Enter {{ $item['paymentName'] }} Phone Number">
                    @else
                        @if ($type === 'L_C')
                            <div class="space-y-4 max-w-md mx-auto">
                                <label for="tnx_phonenumber" class="block text-sm font-medium text-gray-700">
                                    {{ $item['paymentName'] }} Card Info
                                </label>

                                <input type="text" name="tnx_phonenumber" x-model="tnx_phonenumber" placeholder="Enter Phone Number"
                                    class="w-80 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <input type="text" name="cardNumber" x-model="cardNumber"
                                    placeholder="Enter Card Number"
                                    class="w-80 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <div class="flex justify-center">
                                    <div class="flex space-x-4">
                                        <input type="number" name="expiryMonth" x-model="expiryMonth" placeholder="MM"
                                            class="w-24 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                        <input type="number" name="expiryYear" x-model="expiryYear" placeholder="YYYY"
                                            class="w-28 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="space-y-4 max-w-md mx-auto">
                                <label for="cardNumber" class="block text-sm font-medium text-gray-700">
                                    {{ $item['paymentName'] }} Card Info
                                </label>

                                <input type="text" name="cardNumber" x-model="cardNumber"
                                    placeholder="Enter Card Number"
                                    class="w-80 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <input type="text" name="securityCode" x-model="securityCode"
                                    placeholder="Enter Security Code"
                                    class="w-80 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                <div class="flex justify-center">
                                    <div class="flex space-x-4">
                                        <input type="text" name="expiryMonth" x-model="expiryMonth" placeholder="MM"
                                            class="w-24 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                        <input type="text" name="expiryYear" x-model="expiryYear" placeholder="YYYY"
                                            class="w-28 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endif


                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-50 bg-pink-500 text-white  py-2 px-2 rounded-lg hover:bg-pink-500 transition mt-5">
                Submit Payment
            </button>
        </form>
    </div>
</div>

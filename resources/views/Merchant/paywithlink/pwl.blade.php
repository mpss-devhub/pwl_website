@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    @include('Merchant.paywithlink.alert')

    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-16">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6  mx-auto">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h1 class="text-md font-bold text-gray-800">Create Payment Link</h1>
                        <p class="text-xs text-gray-500 mt-1">Generate secure payment links to share with customers</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            Merchant ID: {{ $merchant['merchant_id'] }}
                        </span>
                    </div>
                </div>
                <!-- Payment Form -->
                <form action="{{ route('links.store') }}" method="POST" class="space-y-4" id="paymentForm">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">

                    <!-- Payment Details Section -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1 bg-blue-600 rounded-full"></div>
                            <p class="text-md font-semibold text-gray-800">Payment Details</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-5">
                            <!-- Invoice Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Invoice Number <span class="text-red-500">*
                                        @error('invoiceNo')
                                            <span class="text-[12px]"> {{ $message }}</span>
                                        @enderror
                                    </span>
                                </label>
                                <input name="invoiceNo" type="text" required value="{{ old('invoiceNo') }}"
                                    minlength="3" maxlength="30" oninput="this.value = this.value.replace(/\s/g, '')"
                                    class="w-full px-4 text-gray-700 placeholder-gray-400 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                    placeholder="INV-2023-001">
                            </div>


                            <!-- Amount -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Amount <span
                                        class="text-red-500">*
                                        @error('amount')
                                            <span class="text-[12px]"> {{ $message }}</span>
                                        @enderror
                                    </span></label>
                                <div class="relative">
                                    <div id="currencySymbol"
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Ks</span>
                                    </div>
                                    <input name="amount" id="amountInput" type="number" required
                                        value="{{ old('amount') }}" min="0.01" max="9999999"  step="0.01"
                                        class="pl-12 w-full text-gray-700 placeholder-gray-400 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                        placeholder="1500">
                                </div>
                            </div>

                            <!-- Customer Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name <span
                                        class="text-red-500">*
                                        @error('name')
                                            <span class="text-[12px]"> {{ $message }}</span>
                                        @enderror
                                    </span></label>
                                <input name="name" type="text" required value="{{ old('name') }}" minlength="4"
                                    maxlength="20"
                                    class="w-full text-gray-700 placeholder-gray-400 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                    placeholder="John Doe">
                            </div>

                            <!-- Customer Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Customer Phone <span
                                        class="text-red-500">*</span></label>
                                <input id="customerPhone" name="phone" type="tel" required value="{{ old('phone') }}"
                                    minlength="4" maxlength="14" pattern="[0-9]*" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full text-gray-700 placeholder-gray-400 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                    placeholder="09xxxxxxxxx">
                            </div>

                            <!-- Customer Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                                <input id="customerEmail" name="email" type="email" value="{{ old('email') }}" minlength="4" maxlength="30"
                                    class="w-full text-gray-700 placeholder-gray-400 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                    placeholder="customer@example.com">
                            </div>

                            <!-- Expiry Date/Time -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Expiry Date/Time <span class="text-red-500">*
                                        @error('expired_at')
                                            <span class="text-[12px]"> {{ $message }}</span>
                                        @enderror
                                    </span>
                                </label>
                                <input name="expired_at" type="datetime-local" required value="{{ old('expired_at') }}"
                                    autoFocus min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors">
                            </div>

                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes
                                @error('expired_at')
                                    <span class="text-[12px]"> {{ $message }}</span>
                                @enderror
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full text-gray-700 placeholder-gray-400 px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-colors"
                                placeholder="Additional information about this payment">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Currency Options -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1 bg-blue-600 rounded-full"></div>
                            <p class="text-md font-semibold text-gray-800">Currency Options
                                @error('currency')
                                    <span class="text-[12px]"> {{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                        <div class="grid sm:grid-cols-5 gap-4">
                            <label
                                class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                <input type="radio" name="currency" value="MMK" checked
                                    {{ old('currency', 'MMK') == 'MMK' ? 'checked' : '' }}
                                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <div>
                                    <span class="block text-sm font-medium text-gray-800">MMK (Default)</span>
                                    <span class="block text-xs text-gray-500 mt-1">Myanmar Kyat</span>
                                </div>
                            </label>

                            <label
                                class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                <input type="radio" name="currency" value="USD"
                                    {{ old('currency') == 'USD' ? 'checked' : '' }}
                                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <div>
                                    <span class="block text-sm font-medium text-gray-800">USD</span>
                                    <span class="block text-xs text-gray-500 mt-1">US Dollar</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Delivery Options -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1 bg-blue-600 rounded-full"></div>
                            <p class="text-md font-semibold text-gray-800">Delivery Options
                                @error('notification')
                                    <span class="text-[12px]"> {{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                            @if (!$email->isEmpty())
                                <label
                                    class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                    <input type="radio" name="notification" value="SMS"
                                        {{ old('notification') === 'SMS' ? 'checked' : '' }}
                                        class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <div>
                                        <span class="block text-sm font-medium text-gray-800">SMS</span>
                                        <span class="block text-[11px] text-gray-500 mt-1">Send payment link via SMS</span>
                                    </div>
                                </label>
                            @endif

                            <label
                                class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="Email"
                                    {{ old('notification') === 'Email' ? 'checked' : '' }}
                                    class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <div>
                                    <span class="block text-sm font-medium text-gray-800">Email</span>
                                    <span class="block text-[11px] text-gray-500 mt-1">Send payment link via Email</span>
                                </div>
                            </label>

                            <label
                                class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="Copy" checked
                                    {{ old('notification') === 'Copy' ? 'checked' : '' }}
                                    class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <div>
                                    <span class="block text-sm font-medium text-gray-800">Copy Link</span>
                                    <span class="block text-[11px] text-gray-500 mt-1">Get a copy of the payment
                                        link</span>
                                </div>
                            </label>

                            <label
                                class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="QR"
                                    {{ old('notification') === 'QR' ? 'checked' : '' }}
                                    class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <div>
                                    <span class="block text-sm font-medium text-gray-800">QR Code</span>
                                    <span class="block text-[11px] text-gray-500 mt-1">Generate QR code for payment</span>
                                </div>
                            </label>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 ">
                        <button id="submitButton" type="submit"
                            class="px-6 py-3 bg-[#3164c1] text-white rounded-lg hover:bg-[#2f549a] focus:ring-4 focus:ring-blue-100 transition-colors font-medium shadow-sm flex items-center justify-center">
                            <span id="btnText"><i class="fas fa-link mr-2"></i> Create Payment Link</span>
                            <svg id="btnSpinner" class="hidden ml-2 w-5 h-5 text-white animate-spin" fill="none"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </button>
                        <a href="{{ route('links.bundle') }}"
                            class="px-6 py-3 bg-[#1e8052] text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-100 transition-colors font-medium shadow-sm flex items-center justify-center">
                            <span id="btnText"><i class="fa-solid fa-file-arrow-up mr-2"></i> Excel Upload</span>

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('paymentForm');
            const submitButton = document.getElementById('submitButton');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const loadingOverlay = document.getElementById('loadingOverlay');

            form.addEventListener('submit', function(e) {
                if (submitButton.disabled) {
                    e.preventDefault();
                    return;
                }
                btnText.classList.add('hidden');
                btnSpinner.classList.remove('hidden');
                submitButton.disabled = true;
                loadingOverlay?.classList.remove('hidden');
            });


            const currencyRadios = document.querySelectorAll('input[name="currency"]');
            const currencySymbol = document.getElementById('currencySymbol');


            // Currency symbol update
            function updateCurrencySymbol() {
                const selected = document.querySelector('input[name="currency"]:checked')?.value;
                currencySymbol.innerHTML = selected === 'USD' ? '$' : 'Ks';
            }

            // Initial currency
            updateCurrencySymbol();

            // Listen for changes
            currencyRadios.forEach(radio => {
                radio.addEventListener('change', updateCurrencySymbol);
            });
        });
    </script>
@endsection

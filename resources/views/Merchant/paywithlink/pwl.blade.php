@extends('Merchant.layouts.dashboard')
@section('merchant_content')

    @include('Merchant.paywithlink.alert')

    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl mx-auto">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Create Payment Link</h2>
                        <p class="text-sm text-gray-500 mt-1">Generate a secure payment link to share with your customers</p>
                    </div>
                    <div class="mt-3 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            Merchant ID: {{ $merchant['merchant_id'] }}
                        </span>
                    </div>
                </div>

                <!-- Merchant Info Section -->
                <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-medium text-blue-800">Merchant Information</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Your payment links will be generated under: <span class="font-mono bg-blue-100 px-2 py-1 rounded">https://paywithlink.com/merchant/</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details Form -->
                <form action="{{ route('links.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Payment Details Section -->
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                            <h3 class="text-lg font-semibold text-gray-800">Payment Details</h3>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Invoice Number -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice No <span class="text-red-500">*</span></label>
                                <input name="invoiceNo" type="text" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="INV-2023-001">
                            </div>

                            <!-- Amount -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Amount (MMK) <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Ks</span>
                                    </div>
                                    <input name="amount" type="number" required
                                        class="pl-10 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="10000">
                                </div>
                            </div>

                            <!-- Customer Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name <span class="text-red-500">*</span></label>
                                <input name="name" type="text" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="John Doe">
                            </div>

                            <!-- Customer Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Customer Phone <span class="text-red-500">*</span></label>
                                <div class="flex">
                                    <input name="phone" type="tel" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="09xxxxxxxxx">
                                </div>
                            </div>

                            <!-- Customer Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Customer Email</label>
                                <input name="email" type="email"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="customer@example.com">
                            </div>

                            <!-- Expiry Date/Time -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date/Time <span class="text-red-500">*</span></label>
                                <input name="expired_at" type="datetime-local" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Additional information about this payment"></textarea>
                        </div>
                    </div>

                    <!-- Currency Options -->
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                            <h3 class="text-lg font-semibold text-gray-800">Currency Options</h3>
                        </div>

                        <div class="grid sm:grid-cols-4 gap-4">
                            <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="currency" value="MMK" checked
                                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 rounded-full">
                                <span class="block text-sm font-medium text-gray-700">MMK (Default)</span>
                            </label>

                            <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="currency" value="USD"
                                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 rounded-full">
                                <span class="block text-sm font-medium text-gray-700">USD</span>
                            </label>
                        </div>
                    </div>

                    <!-- Notification Options -->
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                            <h3 class="text-lg font-semibold text-gray-800">Notification & Delivery Options</h3>
                        </div>

                        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
                            @if(!$email->isEmpty())
                            <label class="flex items-start space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="SMS"
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                <div>
                                    <span class="block text-sm font-medium text-gray-700">SMS Notification</span>
                                    <span class="block text-xs text-gray-500 mt-1">Send payment link via SMS</span>
                                </div>
                            </label>
                            @endif

                            <label class="flex items-start space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="Email"
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                <div>
                                    <span class="block text-sm font-medium text-gray-700">Email Notification</span>
                                    <span class="block text-xs text-gray-500 mt-1">Send payment link via Email</span>
                                </div>
                            </label>

                            <label class="flex items-start space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="Copy"
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                <div>
                                    <span class="block text-sm font-medium text-gray-700">Copy Link</span>
                                    <span class="block text-xs text-gray-500 mt-1">Get a copy of the payment link</span>
                                </div>
                            </label>

                            <label class="flex items-start space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                <input type="radio" name="notification" value="QR"
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                <div>
                                    <span class="block text-sm font-medium text-gray-700">Generate QR Code</span>
                                    <span class="block text-xs text-gray-500 mt-1">Create a QR code for this payment</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col-reverse sm:flex-row justify-end space-y-4 sm:space-y-0 space-x-0 sm:space-x-3 pt-6">
                        <button type="button"
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-800 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors font-medium shadow-sm">
                            Create Payment Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

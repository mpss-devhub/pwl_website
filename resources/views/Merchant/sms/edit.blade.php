@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    @include('Merchant.paywithlink.alert')
    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-4 mt-14">
            <div class="max-w-6xl mx-auto">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <!-- Logo and Title -->
                    <div class="flex items-center gap-3">

                        <div>
                            <h1 class="text-md md:text-xl font-bold text-gray-800">Update Payment Link</h1>
                            <p class="text-gray-500 text-sm mt-0.5">Edit your payment link details below</p>
                        </div>

                    </div>

                    <!-- Back Button -->
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('merchant.sms') }}"
                            class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Back to Links
                        </a>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <form action="{{ route('links.update', $link->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- User ID -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">User ID</label>
                                    <input type="text" name="user_id" value="{{ $link->user_id }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required readonly>
                                </div>

                                <!-- Invoice No -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                                    <input type="text" name="invoiceNo"
                                        value="{{ old('invoiceNo', $link->link_invoiceNo) }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                    @error('invoiceNo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input type="number" name="amount" value="{{ old('amount', $link->link_amount) }}"
                                            class="w-full pl-8 px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            required>
                                    </div>
                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Currency -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                                    <select name="currency"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                        <option value="MMK"
                                            {{ old('currency', $link->link_currency) == 'MMK' ? 'selected' : '' }}>MMK
                                        </option>
                                        <option value="USD"
                                            {{ old('currency', $link->link_currency) == 'USD' ? 'selected' : '' }}>USD
                                        </option>
                                    </select>
                                </div>

                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
                                    <input type="text" name="name" value="{{ old('name', $link->link_name) }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $link->link_phone) }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer Email</label>
                                    <input type="email" name="email" value="{{ old('email', $link->link_email) }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                </div>

                                <!-- Expiration -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Expiration Date</label>
                                    <div class="relative">
                                        <input type="datetime-local" name="expired_at"
                                            value="{{ old('expired_at', \Carbon\Carbon::parse($link->expired_at)->format('Y-m-d\TH:i')) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            required>
                                    </div>
                                </div>

                                <!-- Notification -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notifications</label>
                                    <select name="notification"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                        <option value="C"
                                            {{ old('notification', $link->notification) == 'C' ? 'selected' : '' }}>Copy
                                            Link</option>
                                        <option value="Q"
                                            {{ old('notification', $link->notification) == 'Q' ? 'selected' : '' }}>QR
                                        </option>
                                        <option value="S"
                                            {{ old('notification', $link->notification) == 'S' ? 'selected' : '' }}>SMS
                                        </option>
                                        <option value="E"
                                            {{ old('notification', $link->notification) == 'E' ? 'selected' : '' }}>Email
                                        </option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="description" rows="3"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">{{ old('description', $link->link_description) }}</textarea>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-8 flex justify-end space-x-3">
                                <button type="button" onclick="window.location.href='{{ route('merchant.sms') }}'"
                                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Update Payment Link
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

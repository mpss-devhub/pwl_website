@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-12">
            <div class="max-w-7xl mx-auto">


                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="flex items-center justify-between p-4">
                        <div class="">
                            <h2 class="text-sm md:text-md lg:text-md font-semibold text-gray-800 ml-3">
                                Payment Link Details
                                <span
                                    class="text-[10px] bg-blue-400 text-white p-1 mx-2 rounded-lg ">{{ Auth::user()->user_id }}</span>
                            </h2>

                        </div>
                        <div class="">
                            <div class="">
                                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt=""
                                    style="width: 120px;">
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('links.update', $link->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Invoice No -->
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <label class=" text-xs font-medium text-gray-700 mb-2">
                                            Invoice Number
                                            @error('invoiceNo')
                                                <span class="text-red-500 text-[9px] mx-2">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <input type="text" name="invoiceNo"
                                        value="{{ old('invoiceNo', $link->link_invoiceNo) }}" minlength="3" maxlength="30"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                </div>

                                <!-- Amount -->
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <label class="block text-xs font-medium text-gray-700 mb-2">
                                            Amount
                                            @error('amount')
                                                <span class="text-red-500 text-[9px] mx-2">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            @if ($link->link_currency == 'MMK')
                                                <span class="text-gray-500">KS</span>
                                            @endif
                                            @if ($link->link_currency == 'USD')
                                                <span class="text-gray-500">$</span>
                                            @endif

                                        </div>
                                        <input type="number" name="amount" value="{{ old('amount', $link->link_amount) }}"
                                           min="0.01" max="9999999"  step="0.01"
                                            class="w-full pl-8 px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            required>
                                    </div>

                                </div>

                                <!-- Currency -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Currency</label>
                                    <select name="currency"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
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
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Customer Name</label>
                                    <input type="text" name="name" value="{{ old('name', $link->link_name) }}"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Customer Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $link->link_phone) }}"
                                        pattern="[0-9]*" inputmode="numeric" minlength="4" maxlength="14"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Customer Email</label>
                                    <input type="email" name="email" value="{{ old('email', $link->link_email) }}"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" minlength="4" maxlength="16"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                </div>

                                <!-- Expiration -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Expiration Date</label>
                                    <div class="relative">
                                        <input type="datetime-local" name="expired_at" required
                                            value="{{ old('expired_at', \Carbon\Carbon::parse($link->expired_at)->format('Y-m-d\TH:i')) }}"
                                            class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            required>
                                    </div>
                                </div>

                                <!-- Notification -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Notifications</label>
                                    <select name="notification"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        required>
                                        <option value="C"
                                            {{ old('notification', $link->notification) == 'C' ? 'selected' : '' }}>Copy
                                            Link</option>
                                        <option value="Q"
                                            {{ old('notification', $link->notification) == 'Q' ? 'selected' : '' }}>QR
                                        </option>
                                        @if ($sms)
                                            <option value="S"
                                                {{ old('notification', $link->notification) == 'S' ? 'selected' : '' }}>SMS
                                            </option>
                                        @endif
                                        <option value="E"
                                            {{ old('notification', $link->notification) == 'E' ? 'selected' : '' }}>Email
                                        </option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="md:col-span-2">
                                    <div class="flex justify-between items-center mb-1">
                                        <label class="block text-xs font-medium text-gray-700 mb-2">
                                            Description
                                            @error('description')
                                                <span class="text-red-500 text-[9px] mx-2">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <textarea name="description" rows="3"
                                        class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">{{ old('description', $link->link_description) }}</textarea>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-4 flex justify-end space-x-3">
                                <button type="button" onclick="window.location.href='{{ route('merchant.sms') }}'"
                                    class="text-sm px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="text-sm px-4 py-2 bg-blue-900 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
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

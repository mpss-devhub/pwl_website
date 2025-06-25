@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-4 mt-14 max-w-6xl mx-auto">
            <!-- Payment Details Card -->

            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                <!-- Header Section -->
                <div class="bg-white px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $data['payment_logo'] }}" alt="Payment Method"
                                class="rounded-md h-12 w-12 mr-4 object-contain">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Payment Details</h2>
                                <p class="text-gray-500 text-sm mt-1">Transaction ID: {{ $data['tranref_no'] }}</p>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex flex-wrap gap-2 mt-4 mb-6">
                                <a href="{{ url()->previous() }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Back
                                </a>

                                <form action="{{ route('tnx.detail') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}" required>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 focus:bg-pink-700 active:bg-pink-800 focus:outline-none transition ease-in-out duration-150">
                                        <i class="fa-solid fa-circle-info mr-2"></i>
                                        Payment Link
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Payment Information -->
                        <div>
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-100">
                                Payment Information
                                @php
                                    $statusColor =
                                        [
                                            'success' => 'bg-green-100 text-green-800',
                                            'failed' => 'bg-red-100 text-red-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'expired' => 'bg-gray-100 text-gray-800',
                                        ][strtolower($data['payment_status'])] ?? 'bg-blue-100 text-blue-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ ucfirst($data['payment_status']) }}
                                </span>
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Payment Code</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['paymentCode'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Created At</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['payment_created_at'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Expires At</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['payment_expired_at'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Currency</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['currencyCode'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Details -->
                        <div>
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-100">
                                Transaction Details
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Transaction Ref</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['tranref_no'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Bank Ref</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['bank_tranref_no'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Date & Time</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['trans_date_time'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Amount Information -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-200">
                                Amount Details
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Requested Amount</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['req_amount'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Transaction Amount</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['txn_amount'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Net Amount</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['net_amount'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payer Information -->
                        <div>
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-100">
                                Payer Information
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Name</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['payment_user_name'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Phone Number</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['tnx_phonenumber'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Details (if applicable) -->
                        @if ($data['cardNumber'])
                            <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                                <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-200">
                                    Card Details
                                </h3>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3">
                                        <span class="text-sm text-gray-500 col-span-1">Card Number</span>
                                        <span class="text-sm font-medium text-gray-800 col-span-2">•••• •••• ••••
                                            {{ substr($data['cardNumber'], -4) }}</span>
                                    </div>
                                    <div class="grid grid-cols-3">
                                        <span class="text-sm text-gray-500 col-span-1">Expiry Date</span>
                                        <span
                                            class="text-sm font-medium text-gray-800 col-span-2">{{ $data['expiryMonth'] }}/{{ $data['expiryYear'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center text-sm text-gray-500 space-y-2 md:space-y-0">
                        <div>
                            <span>Created by {{ $data['created_by'] }} on {{ $data['created_at'] }}</span>
                        </div>
                        @if ($data['updated_at'] && $data['updated_at'] != $data['created_at'])
                            <div>
                                <span>Last updated by {{ $data['updated_by'] }} on {{ $data['updated_at'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

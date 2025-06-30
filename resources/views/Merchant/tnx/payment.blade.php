@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    @php
        $statusColor =
            [
                'success' => 'bg-green-100 text-green-800',
                'failed' => 'bg-red-100 text-red-800',
                'pending' => 'bg-yellow-100 text-yellow-800',
                'expired' => 'bg-gray-100 text-gray-800',
            ][strtolower($data['payment_status'])] ?? 'bg-blue-100 text-blue-800';
    @endphp

    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen" >
        <div class="p-4 mt-14 max-w-6xl mx-auto">

            <!-- Payment Details Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200" >
                <!-- Header Section -->
                <div class="bg-white px-4 sm:px-6 py-5 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="order-2 sm:order-1">
                            <a href="{{ route('merchant.tnx') }}" class="text-gray-600 hover:text-gray-900">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                        <div class="order-1 sm:order-2">
                            <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="Payment Method"
                                class="rounded-md object-contain w-[100px]">
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 sm:p-6">
                    <!-- Left Column -->
                    <div class="space-y-6 bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-100">
                        <!-- Payment Information -->
                        <div>
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-100 text-center">
                                Payment Information
                            </h3>

                            <div class="space-y-4">
                                <div class="grid grid-cols-3 items-center gap-2">
                                    <span class="text-sm text-gray-600">Status</span>
                                    <span class="col-span-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                            {{ ucfirst($data['payment_status']) }}
                                        </span>
                                    </span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Amount</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['req_amount'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Currency</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['currencyCode'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Payment Code</span>
                                    <span class="text-sm font-medium text-gray-800 col-span-2">
                                        <div class="flex items-center">
                                            <span>{{ $data['paymentCode'] }}</span>
                                            <img src="{{ $data['payment_logo'] }}" class="ml-2 w-5" alt="">
                                        </div>
                                    </span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Created At</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['created_at'] }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span class="text-sm text-gray-500 col-span-1">Expires At</span>
                                    <span
                                        class="text-sm font-medium text-gray-800 col-span-2">{{ $data['payment_expired_at'] }}</span>
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
                            <div class="bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-100">
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

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Amount Information -->
                        <div class="bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-100">
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

                        <!-- Transaction Details -->
                        <div class="bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-200 shadow-sm">
                            <h3 class="text-base font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                Transaction Details
                            </h3>
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="space-y-4 w-full">
                                    <div class="grid grid-cols-3 gap-4">
                                        <span class="text-sm text-gray-600">Invoice No</span>
                                        <span class="text-sm font-medium text-gray-900 col-span-2">
                                            {{ $data['tranref_no'] ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <span class="text-sm text-gray-600">Bank Ref</span>
                                        <span class="text-sm font-medium text-gray-900 col-span-2">
                                            {{ $data['bank_tranref_no'] ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <span class="text-sm text-gray-600">Date & Time</span>
                                        <span class="text-sm font-medium text-gray-900 col-span-2">
                                            {{ $data['trans_date_time'] ? date('d M Y, h:i A', strtotime($data['trans_date_time'])) : '—' }}
                                        </span>
                                    </div>
                                </div>
                                @if ($data['payment_status'] == 'SUCCESS')
                                    <img src="{{ Storage::url('common/success.png') }}" class="mt-1 w-[110px]"
                                        alt="Payment QR" loading="lazy">
                                @endif
                                @if ($data['payment_status'] == 'Pending')
                                    <img src="{{ Storage::url('common/pe.png') }}" class="mt-1 w-[110px]" alt="Payment QR"
                                        loading="lazy">
                                @endif
                                @if ($data['payment_status'] == 'FAIL')
                                    <img src="{{ Storage::url('common/f.png') }}" class="mt-1 w-[110px]" alt="Payment QR"
                                        loading="lazy">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="bg-gray-50 px-4 sm:px-6 py-4 border-t border-gray-200">
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

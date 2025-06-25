@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Payment Link Details</h2>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $sms['link_status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($sms['link_status']) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2">Basic Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Link Name</span>
                                    <span class="font-medium">{{ $sms['link_name'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Invoice No</span>
                                    <span class="font-medium">{{ $sms['link_invoiceNo'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Link Type</span>
                                    <span class="font-medium capitalize">{{ $sms['link_type'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created At</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($sms['created_at'])->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2">Customer Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Customer Name</span>
                                    <span class="font-medium">{{ $sms['link_name'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email</span>
                                    <span class="font-medium">{{ $sms['link_email'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Phone</span>
                                    <span class="font-medium">{{ $sms['link_phone'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2">Payment Details</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Amount</span>
                                    <span class="font-medium">
                                        {{ $sms['link_currency'] }} {{ number_format($sms['link_amount'], 2) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Expires At</span>
                                    <span class="font-medium">
                                        {{ $sms['link_expired_at'] ? \Carbon\Carbon::parse($sms['link_expired_at'])->format('M d, Y H:i') : 'Never' }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Click Status</span>
                                    <span class="font-medium capitalize">{{ $sms['link_click_status'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2">Description</h3>
                            <p class="text-gray-700">{{ $sms['link_description'] ?? 'No description provided' }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2">Payment Link</h3>
                            <div class="flex items-center space-x-2">
                                <input type="text" id="paymentLink" readonly
                                    value="{{ $sms['link_url'] }}"
                                    class="flex-1 p-2 border rounded-lg text-gray-700 bg-gray-100">
                                <button onclick="copyToClipboard()"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Copy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Back to List
                    </a>
                    <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Edit Link
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const copyText = document.getElementById("paymentLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            // Show a tooltip or alert that text was copied
            alert("Payment link copied to clipboard!");
        }
    </script>
@endsection

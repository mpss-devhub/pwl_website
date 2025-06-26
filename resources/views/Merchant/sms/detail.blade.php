@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <div class="flex">
                        <span>
                            <a href="{{ route('merchant.sms') }}"> <i class="fa-solid fa-arrow-left "></i></a>
                        </span>
                        <h2 class="text-xl font-bold text-gray-800 ml-2">Payment Link Details</h2>

                    </div>
                    <div class="">
                        <div class="">
                            <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="" style="width: 150px;">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                @if (!$exists)
                                    <a href="#" class="text-blue-800 rounded-lg ml-2">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </a>
                                @endif

                                <h3
                                    class="font-medium text-gray-500 px-2 {{ $exists ? 'border-l-4 border-l-blue-800 rounded' : '' }}">
                                    Basic Information
                                </h3>
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">From</span>
                                    <span class="text-sm font-semibold">{{ $sms['created_by'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Invoice No</span>
                                    <span class="text-sm font-semibold">{{ $sms['link_invoiceNo'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Sent By</span>
                                    @if ($sms['link_type'] === 'S')
                                        <span class="text-sm font-semibold capitalize">
                                            SMS
                                        </span>
                                    @endif
                                    @if ($sms['link_type'] === 'C')
                                        <span class="textx-sm font-semibold capitalize">
                                            Copy
                                        </span>
                                    @endif
                                    @if ($sms['link_type'] === 'Q')
                                        <span class="text-sm font-semibold capitalize">
                                            QR
                                        </span>
                                    @endif
                                    @if ($sms['link_type'] === 'E')
                                        <span class="text-sm font-semibold capitalize">
                                            Email
                                        </span>
                                    @endif
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Created At</span>
                                    <span
                                        class="text-sm font-semibold">{{ \Carbon\Carbon::parse($sms['created_at'])->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg h-60">

                            <h3 class="font-medium text-gray-500 mb-2 border-l-4 border-l-blue-800 rounded px-2">Description
                            </h3>
                            <p class="text-gray-700">{{ $sms['link_description'] ?? 'No description provided' }}</p>
                        </div>



                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2 text-center">Payment Details</h3>
                            <hr>
                            <div class="space-y-4 mt-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Amount</span>
                                    <span class=" text-sm font-semibold">
                                        {{ $sms['link_currency'] }} {{ number_format($sms['link_amount'], 2) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Expires At</span>
                                    <span class=" text-sm font-semibold">
                                        {{ $sms['link_expired_at'] ? \Carbon\Carbon::parse($sms['link_expired_at'])->format('M d, Y H:i') : 'Never' }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Click Status</span>
                                    <span class=" text-sm font-semibold capitalize">{{ $sms['link_click_status'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-500 mb-2 text-center">Customer Information</h3>
                            <hr>
                            <div class="space-y-4 mt-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 ">Customer Name</span>
                                    <span class="font-semibold text-sm ">{{ $sms['link_name'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Email</span>
                                    <span class="font-semibold text-sm ">{{ $sms['link_email'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 text-sm">Phone</span>
                                    <span class="font-semibold text-sm ">{{ $sms['link_phone'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex">
                                <h3 class="font-medium text-gray-500 mb-2"> <i class="fa-solid fa-link mr-1"></i> Payment
                                    Link</h3>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $sms['link_status'] === 'active' ? ' text-green-800' : ' text-red-800' }}">
                                    ( {{ ucfirst($sms['link_status']) }} )
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="text" id="paymentLink" readonly value="{{ $sms['link_url'] }}"
                                    class="flex-1 p-2 border rounded-lg text-gray-700 text-xs bg-gray-100">
                                <button onclick="copyToClipboard()"
                                    class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
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

@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <style>
        @media print {
            body {
                width: 1366px;
                height: auto;
            }
        }
    </style>

    @php
        $statusColor =
            [
                'success' => 'bg-green-100 text-green-800',
                'failed' => 'bg-red-100 text-red-800',
                'pending' => 'bg-yellow-100 text-yellow-800',
                'expired' => 'bg-gray-100 text-gray-800',
            ][strtolower($data['payment_status'])] ?? 'bg-blue-100 text-blue-800';
    @endphp

    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14 max-w-7xl mx-auto">

            <!-- Payment Details Card -->
            <div id="exportArea" class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                <!-- Header Section -->
                <div class="bg-white px-4 sm:px-6 py-4">
                    <div class="bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-100">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Left Section -->
                            <div class="flex gap-4 items-start">
                                <img src="{{ Storage::url('/common/demo.png') }}" alt="Merchant Image"
                                    class="w-24 h-24 rounded-lg object-cover">

                                <div class="mt-1 space-y-2">
                                          <div class="grid grid-cols-2 gap-x-20">
                                        <span class="text-sm font-semibold text-gray-600">Merchant Name</span>
                                        <span class="text-sm  text-gray-900 text-right">{{ Auth::user()->name }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-x-20">
                                        <span class="text-sm font-semibold text-gray-600">Merchant ID</span>
                                        <span class="text-sm  text-gray-900 text-right">{{ $details['merchantID'] }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-x-20">
                                        <span class="text-sm font-semibold text-gray-600">Merchant Since</span>
                                        <span class="text-sm  text-gray-900 text-right ">{{ Auth::user()->created_at->format('Y-M-D') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section -->
                            <div class="space-y-2">
                                <div class="grid grid-cols-2 gap-x-4">
                                    <span class="text-sm font-semibold text-gray-600">Settlement Status</span>
                                    <span class="text-sm text-gray-800 text-right">
                                        <span
                                                class="inline-block px-3  rounded-full ml-5 text-xs  leading-5
                                                {{ !empty($details['settlementStatus']) ? 'bg-green-100 text-green-800' : 'bg-[#3b9bb3] text-white' }}">
                                                {{ !empty($details['settlementStatus']) ? $details['settlementStatus'] : 'Waiting' }}
                                            </span>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <span class="text-sm font-semibold text-gray-600">Settlement Date</span>
                                    <span class="text-sm text-gray-800 text-right">
                                        <span
                                                class="inline-block px-3  rounded-full ml-5 text-xs  leading-5
                                                {{ !empty($details['settlementDate']) ? 'bg-green-100 text-green-800' : 'bg-[#f8c885] text-gray-50' }}">
                                                {{ !empty($details['settlementDate']) ? $details['settlementDate'] : 'Waiting' }}
                                            </span>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <span class="text-sm font-semibold text-gray-600">MDR Rate</span>
                                    <span class="text-sm text-gray-800 text-right">
                                        <span class="text-gray-800 ">{{ $details['merchantFeeRate'] }}</span>
                                        (<span class="text-xs text-gray-600 mx-1">{{ $details['merchantFeeType'] }}</span>)
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-2 sm:p-4">
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
                            <h3 class="text-base font-medium text-gray-700 mb-4 pb-2 border-b border-gray-100 text-center">
                              Customer Information
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
                                    <img src="{{ Storage::url('common/pe.png') }}" class="mt-1 w-[110px]"
                                        alt="Payment QR" loading="lazy">
                                @endif
                                @if ($data['payment_status'] == 'FAIL')
                                    <img src="{{ Storage::url('common/f.png') }}" class="mt-1 w-[110px]"
                                        alt="Payment QR" loading="lazy">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Footer Section -->
            <div class="bg-gray-50 px-4 sm:px-6 py-4 border-t border-gray-200 rounded-lg mt-1">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center text-sm text-gray-500 space-y-2 md:space-y-0">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-6 mb-2 ">

                        <a href="{{ route('tnx.show') }}" class="text-gray-600 hover:text-gray-900   flex items-center">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            <span class="mx-1">Back</span>
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3 ml-2">
                        <button id="btn-png" onclick="downloadAsPNG()"
                            class="flex items-center gap-2 bg-blue-100 text-blue-700 hover:bg-blue-200 px-4 py-2 rounded-md transition">
                            <svg id="loading-png" class="hidden w-4 h-4 animate-spin text-blue-700"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span id="text-png">Download as <i class="fa-solid fa-image"></i></span>
                        </button>

                        <button id="btn-pdf" onclick="downloadAsPDF()"
                            class="flex items-center gap-2 bg-red-100 text-red-600 hover:bg-red-200 px-4 py-2 rounded-md transition">
                            <svg id="loading-pdf" class="hidden w-4 h-4 animate-spin text-red-600"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span id="text-pdf">Download as <i class="fa-solid fa-file-pdf"></i> </span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function showLoading(id) {
            document.getElementById(`loading-${id}`).classList.remove('hidden');
            document.getElementById(`text-${id}`).textContent = "Processing...";
            document.getElementById(`btn-${id}`).disabled = true;
        }

        function hideLoading(id, originalText) {
            document.getElementById(`loading-${id}`).classList.add('hidden');
            document.getElementById(`text-${id}`).textContent = originalText;
            document.getElementById(`btn-${id}`).disabled = false;
        }

        function downloadAsPNG() {
            showLoading('png');
            const element = document.getElementById("exportArea");

            html2canvas(element, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement("a");
                link.download = "payment-details.png";
                link.href = canvas.toDataURL("image/png");
                link.click();

                hideLoading('png', 'Download as PNG');
            });
        }

        async function downloadAsPDF() {
            showLoading('pdf');
            const {
                jsPDF
            } = window.jspdf;
            const element = document.getElementById("exportArea");

            const canvas = await html2canvas(element, {
                scale: 2,
                useCORS: true
            });
            const imgData = canvas.toDataURL("image/png");

            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'px',
                format: [canvas.width, canvas.height]
            });

            pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
            pdf.save("payment-details.pdf");

            hideLoading('pdf', 'Download as PDF');
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@endsection

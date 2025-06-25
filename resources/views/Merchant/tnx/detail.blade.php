@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-4 mt-14">


            <!-- Link Details Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between">
                    <div class="flex space-x-2">
                        @if (!empty($logo['merchant_logo']))
                            <img src="{{ $logo['merchant_logo'] }}"
                                class="w-16 h-16 rounded-full object-cover border-2 border-gray-200" alt="Merchant Logo">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                                <span class="text-gray-500 text-xs font-medium">No Logo</span>
                            </div>
                        @endif
                        <div class="mt-1">
                            <h3 class="text-lg font-medium text-gray-900">Payment Link Details</h3>
                            <p class="mt-1 text-sm text-gray-500">Detailed information about this payment link</p>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <div class="">
                            <a href="{{ url()->previous() }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                        <div class="">
                            <form action="{{ route('Payment.detail') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}" required>
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none transition ease-in-out duration-150">
                                    <i class="fa-solid fa-building-columns mr-2"></i>
                                    Payment
                                </button>
                            </form>

                        </div>
                    </div>

                </div>

                <div class="bg-white px-6 py-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Invoice Number</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_invoiceNo'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Customer Name</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_name'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_phone'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_email'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Currency</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_currency'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Amount</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_amount'] }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Description</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_description'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Type</label>
                            @if ($links['link_type'] === 'C')
                                <p class="mt-1 text-sm font-semibold text-gray-900">Copy</p>
                            @endif
                            @if ($links['link_type'] === 'Q')
                                <p class="mt-1 text-sm font-semibold text-gray-900">QR</p>
                            @endif
                            @if ($links['link_type'] === 'S')
                                <p class="mt-1 text-sm font-semibold text-gray-900">SMS</p>
                            @endif
                            @if ($links['link_type'] === 'E')
                                <p class="mt-1 text-sm font-semibold text-gray-900">Email</p>
                            @endif
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-500">Click Status</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_click_status'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Expires At</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['link_expired_at'] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created By</label>
                            <p class="mt-1 text-sm font-semibold text-gray-900">{{ $links['created_by'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Link URL Section -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200  ">
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Link URL
                            <span
                                    class="px-2 py-1 rounded-full text-xs
                                    {{ $links['link_status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $links['link_status'] }}
                                </span>
                         </label>
                        <div class="flex">
                            <input type="text" value="{{ $links['link_url'] }}"
                                class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                readonly>
                            <button onclick="copyToClipboard('{{ $links['link_url'] }}')"
                                class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 rounded-r-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Copy
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Hello ,Link copied to clipboard!');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection

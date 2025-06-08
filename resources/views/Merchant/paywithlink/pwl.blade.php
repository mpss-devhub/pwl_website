@extends('Merchant.layouts.dashboard')
@section('merchant_content')
@if (session('success'))
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }} {{ session('link_url') }}',
                confirmButtonText: 'OK'
            });
</script>

@else

@endif
<div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
    <div class="p-4 mt-14">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Create Payment Link</h2>

            </div>

            <!-- Merchant Info Section -->
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-medium text-blue-800 mb-2">Merchant Information</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Frontend URL</label>
                        <div class="flex items-center bg-white px-3 py-2 rounded-md border border-gray-200">
                            <span class="text-gray-600 text-sm">https://paywithlink.com/merchant/</span>
                            <button class="ml-auto text-blue-600 hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Merchant ID</label>
                        <div class="flex items-center bg-white px-3 py-2 rounded-md border border-gray-200">
                            <span class="text-gray-600 text-sm">{{ Auth::user()->user_id }}</span>
                            <button class="ml-auto text-blue-600 hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Section -->
            <form action="{{ route('links.store') }}" method="POST">
                @csrf
                <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-800">Payment Details</h3>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Invoice No <span class="text-red-500">*</span></label>
                            <input name="invoiceNo" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount (MMK) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Ks</span>
                                </div>
                                <input name="amount" type="number" class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name <span class="text-red-500">*</span></label>
                        <input name="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Customer Phone <span class="text-red-500">*</span></label>
                        <div class="flex">

                            <input name="phone" type="tel" class="flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Customer Email</label>
                        <input name="email" type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date/Time <span class="text-red-500">*</span></label>
                        <input name="expired_at" type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-800">Currency Code</h3>
                </div>

                <div class="grid sm:grid-cols-4 gap-4 mb-4">
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="sms" name="currency" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="MMK">
                        <label for="sms" class="ml-2 text-sm font-medium text-gray-700">MMK</label>
                    </div>
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="email" name="currency" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="USD">
                        <label for="email" class="ml-2 text-sm font-medium text-gray-700">USD</label>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-1 bg-blue-600 rounded-full mr-3"></div>
                    <h3 class="text-lg font-semibold text-gray-800">Notification Options</h3>
                </div>

                <div class="grid sm:grid-cols-4 gap-4 mb-4">
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="sms" name="notification" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="SMS" name="type">
                        <label for="sms" class="ml-2 text-sm font-medium text-gray-700">SMS Notification</label>
                    </div>
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="email" name="notification" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="Email" name="type">
                        <label for="email" class="ml-2 text-sm font-medium text-gray-700">Email Notification</label>
                    </div>
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="push" name="notification" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="Copy" name="type">
                        <label for="push" class="ml-2 text-sm font-medium text-gray-700">Copy Link</label>
                    </div>
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <input type="checkbox" id="push" name="notification" class="h-4 w-4 text-blue-600 focus:ring-blue-500 rounded-lg" value="QR" name="type">
                        <label for="push" class="ml-2 text-sm font-medium text-gray-700">Generate QR</label>
                    </div>
                </div>
            </div>
             <div class="flex justify-end space-x-3">
                    <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-blue-200 transition-colors">
                        Create
                    </button>
             </div>
            </form>

        </div>
    </div>
</div>



@endsection

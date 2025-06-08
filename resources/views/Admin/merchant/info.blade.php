@extends('Admin.layouts.dashboard')
@section('admin_content')
    @foreach ($details as $detail)
        <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
            <div class="p-4 mt-14">

                <!-- Main Content Grid -->
                <div class="grid lg:grid-cols-4 gap-6">
                    <!-- Left Column - Profile Section -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Profile Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Merchant Logo</h2>

                            <div class="flex flex-col items-center">
                                <div class="relative mb-4 group">
                                    <img src="{{ $detail->merchant_logo }}" alt="Merchant Profile"
                                        class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <label for="file-upload" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <input type="file" id="file-upload" name="merchant_logo" accept="image/*" class="hidden"
                                    disabled>
                                <label for="file-upload"
                                    class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 cursor-pointer transition-colors mb-1">
                                    <i class="fas fa-upload mr-2"></i>Upload Logo
                                </label>
                                <p class="text-xs text-gray-500 text-center">JPG, PNG (1:1 ratio, max 2MB)</p>
                            </div>

                            <div class="mt-6 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Merchant ID</label>
                                    <div class="flex items-center bg-gray-100 px-3 py-2 rounded-md">
                                        <span class="text-gray-600">{{ $detail->merchant_id }}</span>
                                        <button class="ml-auto text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path
                                                    d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                                            <span class="ml-2 text-gray-700">Active</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-gray-700">Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Merchant Summary</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Created On</span>
                                    <span class="text-sm font-medium">-</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Last Updated</span>
                                    <span class="text-sm font-medium">-</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Transactions</span>
                                    <span class="text-sm font-medium">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Forms -->
                    <div class="lg:col-span-3 space-y-6">
                        <!-- Basic Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Your Informaion</span>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Name</label>
                                    <input value="{{ $detail->merchant_name }}" disabled type="text" id='name'
                                        name="merchant_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Name</label>
                                    <input value="{{ $detail->merchant_Cname }}" disabled type="text"
                                        name="merchant_Cname"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                                    <div class="flex">

                                        <input value="{{ $detail->merchant_Cphone }}" disabled type="tel"
                                            name="merchant_Cphone"
                                            class="flex-1 px-3 py-2 border-t border border-b border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                                    <input value="{{ $detail->merchant_Cemail }}" disabled type="email"
                                        name="merchant_Cemail"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- URL Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">URL Information</h2>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Frontend URL</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            https://
                                        </span>
                                        <input value="{{ $detail->merchant_frontendURL }}" disabled type="text"
                                            name="merchant_frontendURL"
                                            class="flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Backend URL</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            https://
                                        </span>
                                        <input value="{{ $detail->merchant_backendURL }}" disabled type="text"
                                            name="merchant_backendURL"
                                            class="flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Address</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            Address
                                        </span>
                                        <input type="text" value="{{ $detail->merchant_address }}" disabled
                                            name="merchant_address"
                                            class="flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notify Email</label>
                                    <input type="email" value="{{ $detail->merchant_notifyemail }}" disabled
                                        name="merchant_notifyemail"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Required Documents</h2>

                            <div class="grid md:grid-cols-1 gap-6">
                                <div class=" flex-wrap flex justify-between ">
                                    <!-- Company Registration -->
                                    <div class="border py-5 px-20 rounded-lg mt-2 ">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Registration</label>
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ $detail->merchant_registration }}" download
                                                class="">
                                                <i class="fa-solid fa-file-arrow-down mx-1"></i>
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Shareholder List -->
                                    <div class="border py-5 px-20 rounded-lg mt-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Extract
                                            </label>
                                        <div>
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ $detail->merchant_registration }}" download
                                                    class="">
                                                    <i class="fa-solid fa-file-arrow-down mx-1"></i>
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- DICA File -->
                                    <div class="border py-5 px-20 rounded-lg mt-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Corporate Profile</label>
                                        <div>
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ $detail->merchant_registration }}" download
                                                    class="">
                                                    <i class="fa-solid fa-file-arrow-down mx-1"></i>
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                                        <textarea  rows="5" name="merchant_remark" disabled
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Any additional notes...">{{ $detail->merchant_remark}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

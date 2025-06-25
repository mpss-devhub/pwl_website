@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
        <div class="p-4 mt-14">
            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Left Column - Profile Section -->
                <div class="lg:col-span-1">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 rounded-lg shadow ">
                       <a href="" class="text-decoration-none">
                         <i class="fa-solid fa-arrow-left mr-2 "></i>
                        <span>To Dashboard</span>
                       </a>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow mt-3">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Octoverse Merchant
                        <span class="ml-2 px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Active</span>
                        </h2>
                        <div class="mt-6">
                            <div class="flex flex-col items-center">
                                <div class="relative mb-4 group">
                                    <img src="{{ $Merchantinfo['merchant_logo'] }}" alt="Merchant Profile"
                                        class="w-44 h-44 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <label for="file-upload" class="cursor-pointer">
                                            <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt=""
                                                class="w-12">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 space-y-6">

                                 <div class="">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 "> Notifaction Method <i class="fa-solid fa-bell ml-1"></i></label>
                                    <div class="flex justify-between mt-4">
                                        <div class="">
                                        <p class="text-xs font-semibold text-gray-700 "> SMS </p>
                                    </div>
                                    <div class="">
                                        <p class="text-xs font-semibold text-gray-700 border-b-2"> Email </p>
                                    </div>
                                    <div class="">
                                        <p class="text-xs font-semibold text-gray-700 border-b-2"> Link </p>
                                    </div>
                                    <div class="">
                                        <p class="text-xs font-semibold text-gray-700 border-b-2"> QR </p>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow mt-3">
                        <h2 class="text-lg font-semibold text-gray-800">Download Information  <i class="fa-solid fa-cloud-arrow-down"></i></h2>

                        <div class=" space-y-2 mt-4 ">
                            <!-- Company Registration -->
                            <div class="border flex  py-2 tx rounded-lg hover:shadow-sm ">
                                <a href="{{ $Merchantinfo['merchant_registration'] }}" download class="">
                                    <p class="flex text-sm font-medium text-gray-700 mb-2 mx-10">Company Registration
                                    </p>

                                </a>
                            </div>

                            <!-- Shareholder List -->
                            <div class="border flex  py-2 tx rounded-lg hover:shadow-sm">
                                <a href="{{ $Merchantinfo['merchant_shareholder'] }}" download class="">
                                    <p class="flex text-sm font-medium text-gray-700 mb-2  mx-14">Company Extract
                                    </p>
                                </a>
                            </div>
                            <!-- DICA File -->
                            <div class="border flex  py-2 tx rounded-lg hover:shadow-sm">

                                <a href="{{ $Merchantinfo['merchant_dica'] }}" download class="">
                                    <p class="flex text-sm font-medium text-gray-700 mb-2 mx-14">Corporate Profile</p>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Forms -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Basic Information Section -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800"><i class="fa-regular fa-circle-user mr-2"></i> Basic Information</h2>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">User ID :
                                {{ Auth::user()->user_id }}</span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 space-y-1">
                            <div class="">
                                <label
                                    class="block mb-1 text-sm  border border-t-0 border-r-0 border-b-0 border-l-4 border-l-blue-800 rounded px-2">Merchant
                                    Name </label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_name'] }}</p>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm ">Merchant ID </label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_id'] }}</p>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm ">Contact Phone </label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_Cphone'] }}</p>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm ">Contact Email </label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_Cemail'] }}</p>

                            </div>
                        </div>
                    </div>

                    <!-- URL Information Section -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4"> <i
                                class="fa-solid fa-earth-americas mr-2"></i> URL Information</h2>

                        <div class="grid md:grid-cols-2 gap-4 space-y-1">
                            <div>
                                <label
                                    class="block text-sm mb-1 border border-t-0 border-r-0 border-b-0 border-l-4 border-l-blue-800 rounded px-2">Frontend
                                    URL</label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_frontendURL'] }}</p>

                            </div>
                            <div>
                                <label class="block mb-1 text-sm ">Contact Name </label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_Cname'] }}</p>
                            </div>
                            <div>
                                <label class="block text-sm  mb-1">Notify Email</label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_notifyemail'] }}</p>
                            </div>
                            <div>
                                <label class="block text-sm  mb-1">Merchant Address</label>
                                <p class="mt-3 text-sm font-medium text-gray-700">{{ $Merchantinfo['merchant_address'] }}</p>
                            </div>

                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="bg-white p-6 rounded-lg shadow mt-4">
                        <h2
                            class="block text-sm font-medium text-gray-700 mb-1 border border-t-0 border-r-0 border-b-0 border-l-4 border-l-blue-800 rounded px-2">
                            Other Information</h2>
                        <div class="mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                                <textarea rows="3" name="merchant_remark" disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Any additional notes...">{{ $Merchantinfo['merchant_remark'] }}</textarea>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

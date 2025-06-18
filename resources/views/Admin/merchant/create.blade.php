@extends('Admin.layouts.dashboard')
@section('admin_content')
    <form action="{{ route('merchant.store') }}" method="POST" enctype="multipart/form-data">
       @csrf
       <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
    <div class="p-4 mt-14">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Create New Merchant</h1>
                <p class="text-sm text-gray-600">Fill in the merchant details below</p>
            </div>
            <div class="flex space-x-3">
                <button type="submit" id='btn' class="px-5 py-2.5 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 transition-colors">
                    <i class="fas fa-save mr-2"></i>Save Merchant
                </button>
                <button type="button" class="px-5 py-2.5 text-sm font-medium text-gray-800 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Left Column - Profile Section -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Merchant Logo</h2>

                    <div class="flex flex-col items-center">
                        <div class="relative mb-4 group">
                            <img src="{{ Storage::url('common/undraw_profile.svg') }}" alt="Merchant Profile"  id="output"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                            <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <label for="file-upload" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <input type="file" id="file-upload" name="merchant_logo" accept="image/*" class="hidden" onchange="loadFile(event)">
                        <label for="file-upload" class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 cursor-pointer transition-colors mb-1">
                            <i class="fas fa-upload mr-2"></i>Upload Logo
                        </label>
                        <p class="text-xs text-gray-500 text-center">JPG, PNG (1:1 ratio, max 2MB)</p>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Merchant ID</label>
                            <div class="flex items-center bg-gray-100 px-3 py-2 rounded-md">
                                <span class="text-gray-600">Auto-generated</span>
                                <button class="ml-auto text-gray-500 hover:text-gray-700" type="button" id="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                                    <span class="ml-2 text-gray-700">Active</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">This Merchant will be</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Created by</span>
                            <span class="text-sm font-medium">{{  Auth::user()->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Who work at</span>
                            <span class="text-sm font-medium">{{Auth::user()->permission->user_group}} Dep</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">User ID</span>
                            <span class="text-sm font-medium">{{  Auth::user()->user_id }}</span>
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
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Required Fields</span>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Name <span class="text-red-500">*</span></label>
                            <input type="text" id='name' name="merchant_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Name <span class="text-red-500">*</span></label>
                            <input type="text" name="merchant_Cname" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Phone <span class="text-red-500">*</span></label>
                            <div class="flex">

                                <input type="tel" name="merchant_Cphone" class="flex-1 px-3 py-2 border-t border border-b border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email <span class="text-red-500">*</span></label>
                            <input type="email" name="merchant_Cemail" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                                <span class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    https://
                                </span>
                                <input type="text" name="merchant_frontendURL" class="  flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notify Email</label>
                            <input type="email" name="merchant_notifyemail" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Address</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                  Address
                                </span>
                                <input type="text" name="merchant_address" class="flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Documents Section -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Required Documents</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <!-- Company Registration -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Registration</label>
                                <div class="flex items-center space-x-3">
                                    <label class="flex-1">
                                        <div class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-sm text-gray-500 mt-2">Click to upload</p>
                                            <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                        </div>
                                        <input type="file" class="hidden" name="merchant_registration" accept=".pdf,.jpg,.png">
                                    </label>
                                </div>
                            </div>

                            <!-- Shareholder List -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Extract</label>
                                <div class="flex items-center space-x-3">
                                    <label class="flex-1">
                                        <div class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-sm text-gray-500 mt-2">Click to upload</p>
                                            <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                        </div>
                                        <input type="file" class="hidden" name="merchant_shareholder" accept=".pdf,.jpg,.png">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <!-- DICA File -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Corporate Profile</label>
                                <div class="flex items-center space-x-3">
                                    <label class="flex-1">
                                        <div class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-sm text-gray-500 mt-2">Click to upload</p>
                                            <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                        </div>
                                        <input type="file" class="hidden" name="merchant_dica" accept=".pdf,.jpg,.png">
                                    </label>
                                </div>
                            </div>

                            <!-- Remarks -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                                <textarea rows="5" name="merchant_remark" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Any additional notes..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" id="user_id" name="user_id"></input>
    <input type="hidden" id="password" name="password"></input>
    <input type="hidden" class="" id="" name="role" value="merchant"></input>
    </form>
    <script>
  function loadFile(event) {
    var reader = new FileReader();

    reader.onload = function () {
      var output = document.getElementById("output");
      output.src = reader.result;

    }
    reader.readAsDataURL(event.target.files[0]);
  }

</script>
        <script>
        function shuffleString(str) {
            return str.split('').sort(() => Math.random() - 0.5).join('');
        }

        document.getElementById('btn').addEventListener('click', function() {
            const name = document.getElementById('name').value.replace(/\s+/g, ''); // remove all spaces
            const digits = Math.floor(1000 + Math.random() * 9000).toString();
            const mixed = shuffleString(name + digits);
            document.getElementById('password').value = mixed;
            console.log('Generated Mixed Password:', mixed);
        });
    </script>
    <script>
        document.getElementById('btn').addEventListener('click', function() {
            const name = document.getElementById('name').value.trim();
            if (!name) return alert('Please enter a name');

            const firstLetter = name.charAt(0).toUpperCase();
            const digits = Math.floor(1000 + Math.random() * 9000); // 4-digit random number
            const userId = 'M_' + firstLetter + digits;

            document.getElementById('user_id').value = userId;
            console.log('Generated user_id:', userId);
        });
    </script>
@endsection

@extends('Admin.layouts.dashboard')
@section('admin_content')
    <form action="{{ route('merchant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
            <div class="p-4 mt-14">
                <!-- Page Header -->

                <!-- Main Content Grid -->
                <div class="grid lg:grid-cols-4 gap-6">
                    <!-- Left Column - Profile Section -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Profile Card -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                            <div class="order-1 md:order-none">
                                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Create New Merchant</h1>
                                <p class="text-xs md:text-sm text-gray-600">Fill in the merchant details below</p>
                            </div>

                        </div>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Merchant Logo
                                <span class="text-red-500 ">*
                                </span>
                            </h2>

                            <div class="flex flex-col items-center">
                                <div class="relative mb-4 group">
                                    <img src="{{ Storage::url('common/undraw_profile.svg') }}" alt="Merchant Profile"
                                        id="output"
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
                                    required onchange="validateImage(event)">
                                <label for="file-upload"
                                    class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 cursor-pointer transition-colors mb-1">
                                    <i class="fas fa-upload mr-2"></i>Upload Logo
                                </label>
                                <p class="text-xs text-gray-500 text-center">JPG, PNG (must be 300×300px, max 2MB)</p>
                            </div>

                            <div class="mt-6 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Status
                                        <span class="text-red-500 ">*
                                        </span>
                                    </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 " value="on">
                                            <span class="ml-2 text-gray-700">Active</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 " value="off">
                                            <span class="ml-2 text-gray-700">Inactive</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="password" id="password">
                        <input type="hidden" name="role" value="merchant">
                        <div class="flex flex-col xs:flex-row gap-2 w-full md:w-auto order-2 md:order-none">
                            <button type="submit"
                                class="px-4 py-2 md:px-5 md:py-2.5 text-xs md:text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 transition-colors flex items-center justify-center">
                                <span class="text"><i class="fas fa-save mr-2 text-xs md:text-sm"></i>Save Merchant</span>
                                <span class="spinner" style="display:none;">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                            </button>

                            <button type="button"
                                class="px-4 py-2 md:px-5 md:py-2.5 text-xs md:text-sm font-medium text-gray-800 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors flex items-center justify-center">
                                <a href="{{ route('merchant.show') }}">
                                    <i class="fas fa-times mr-2 text-xs md:text-sm"></i>Cancel</a>
                            </button>
                        </div>
                        <!-- Quick Stats Card -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-md font-semibold text-gray-800 mb-4">This Merchant will be</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Created by</span>
                                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Who work at</span>
                                    <span class="text-sm font-medium">{{ Auth::user()->permission->user_group }} Dep</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">User ID</span>
                                    <span class="text-sm font-medium">{{ Auth::user()->user_id }}</span>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Name
                                        <span class="text-red-500 text-[11px]">
                                            @error('merchant_name')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" id='name' name="merchant_name"
                                        value="{{ old('merchant_name') }}" required
                                        class="@error('merchant_name') border-red-400 focus:outline-none @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Name
                                          <span class="text-red-500 text-[11px]">
                                            @error('merchant_Cname')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    <input type="text" name="merchant_Cname" value="{{ old('merchant_Cname') }}"
                                        required
                                        class="@error('merchant_Cname') border-red-400 focus:outline-none @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Phone
                                             <span class="text-red-500 text-[11px]">
                                            @error('merchant_Cphone')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    <div class="flex">
                                        <input type="tel" name="merchant_Cphone" value="{{ old('merchant_Cphone') }}"
                                            required minlength="4" maxlength="12"
                                            class="@error('merchant_Cphone') border-red-400 focus:outline-none @enderror flex-1 px-3 py-2 border-t border border-b border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email
                                          <span class="text-red-500 text-[11px]">
                                            @error('merchant_Cemail')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    <input type="email" name="merchant_Cemail" value="{{ old('merchant_Cemail') }}"
                                        required
                                        class="@error('merchant_Cemail') border-red-400 focus:outline-none @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- URL Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">URL Information</h2>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Frontend URL
                                        <span class="text-red-500 text-[11px]">
                                            @error('merchant_frontendURL')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    </label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            https://
                                        </span>
                                        <input type="text" name="merchant_frontendURL"
                                            value="{{ old('merchant_frontendURL') }}"
                                            class="@error('merchant_frontendURL') border-red-400 focus:outline-none @enderror  flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notify Email
                                         <span class="text-red-500 text-[11px]">
                                            @error('merchant_notifyemail')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="email" name="merchant_notifyemail"
                                        value="{{ old('merchant_notifyemail') }}" required
                                        class="@error('merchant_notifyemail') border-red-400 focus:outline-none @enderror w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Merchant Address</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            Address
                                        </span>
                                        <input type="text" name="merchant_address"
                                            value="{{ old('merchant_address') }}"
                                            class="@error('merchant_address') border-red-400 focus:outline-none @enderror flex-1 px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Company
                                            Registration</label>
                                        <div class="flex items-center space-x-3">
                                            <label class="flex-1">
                                                <div
                                                    class="upload-box flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="upload-icon h-10 w-10 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <p class="upload-text text-sm text-gray-500 mt-2">Click to upload</p>
                                                    <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                                </div>
                                                <input type="file" class="hidden file-input"
                                                    name="merchant_registration" accept=".pdf,.jpg,.png">
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Shareholder List -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Extract</label>
                                        <div class="flex items-center space-x-3">
                                            <label class="flex-1">
                                                <div
                                                    class="upload-box flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="upload-icon h-10 w-10 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <p class="upload-text text-sm text-gray-500 mt-2">Click to upload</p>
                                                    <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                                </div>
                                                <input type="file" class="hidden file-input"
                                                    name="merchant_shareholder" accept=".pdf,.jpg,.png">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <!-- DICA File -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Corporate
                                            Profile</label>
                                        <div class="flex items-center space-x-3">
                                            <label class="flex-1">
                                                <div
                                                    class="upload-box flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors p-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="upload-icon h-10 w-10 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <p class="upload-text text-sm text-gray-500 mt-2">Click to upload</p>
                                                    <p class="text-xs text-gray-400">PDF, JPG, PNG (max 2MB)</p>
                                                </div>
                                                <input type="file" class="hidden file-input" name="merchant_dica"
                                                    accept=".pdf,.jpg,.png">
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Remarks
                                           <span class="text-red-500 text-[11px]">
                                            @error('merchant_remark')
                                               <span class="mx-2"> {{ $message }}</span>
                                            @enderror
                                        </span>
                                        </label>
                                        <textarea rows="5" name="merchant_remark"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Any additional notes..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script>
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    if (file.size > 2 * 1024 * 1024) {
                        alert("File size must be less than 2MB!");
                        this.value = "";
                    }
                }
                const box = this.closest('label').querySelector('.upload-box');
                const icon = box.querySelector('.upload-icon');
                const text = box.querySelector('.upload-text');
                if (this.files.length > 0) {
                    box.classList.remove('border-gray-300', 'bg-gray-50');
                    box.classList.add('border-yellow-500', 'bg-yellow-50');
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-yellow-500');
                    text.textContent = this.files[0].name; // Show file name
                    text.classList.add('text-gray-600');
                } else {
                    box.classList.remove('border-green-500', 'bg-green-50');
                    box.classList.add('border-gray-300', 'bg-gray-50');
                    icon.classList.remove('text-green-500');
                    icon.classList.add('text-gray-400');
                    text.textContent = "Click to upload";
                    text.classList.remove('text-green-600');
                }
            });
        });
    </script>
    <script>
        function loadFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById("output");
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Function to shuffle string for password generation
        function shuffleString(str) {
            return str.split('').sort(() => Math.random() - 0.5).join('');
        }

        // Function to generate credentials
        function generateCredentials() {
            const name = document.getElementById('name').value.trim();
            if (name) {
                // Generate user ID
                const firstLetter = name.charAt(0).toUpperCase();
                const digits = Math.floor(1000 + Math.random() * 9000);
                const userId = 'M_' + firstLetter + digits;
                document.getElementById('user_id').value = userId;
                console.log('Generated User ID:', userId);

                // Generate password
                const nameWithoutSpaces = name.replace(/\s+/g, '');
                const passDigits = Math.floor(1000 + Math.random() * 9000).toString();
                const password = shuffleString(nameWithoutSpaces + passDigits);
                document.getElementById('password').value = password;
                console.log('Generated Password:', password);
            }
        }

        document.getElementById('name').addEventListener('input', generateCredentials);

        // Also generate on form submit to ensure values are set
        document.querySelector('form').addEventListener('submit', function(e) {
            generateCredentials();

            // Show loading spinner
            const btn = document.querySelector('button[type="submit"]');
            if (btn) {
                const text = btn.querySelector('.text');
                const spinner = btn.querySelector('.spinner');
                if (text && spinner) {
                    text.style.display = 'none';
                    spinner.style.display = 'inline-block';
                }
            }

        });
    </script>
@endsection

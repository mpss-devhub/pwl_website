@extends('Merchant.layouts.dashboard')
@section('merchant_content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif


    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14 sm:mt-16">
            <div class="bg-white shadow-md rounded-lg p-4 sm:p-6 ">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-0">
                    <p class="text-sm sm:text-md font-semibold text-gray-800">
                        Bundle Upload With Excel
                    </p>
                    <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-20 sm:w-24" alt="Octoverse Logo">
                </div>

                <hr class="my-4 sm:my-5 border-gray-300">

                <!-- Example Table Section -->
                <div class="overflow-x-auto">


                    <p class="text-xs  text-gray-500 mb-4">
                        Make sure to fill correctly
                        For expired_at use format <code class="bg-gray-100 px-1 py-0.5 rounded">YYYY-MM-DDTHH:MM</code>
                        (e.g., 2025-07-12T15:39).

                    </p>

                    <div class="border rounded-lg overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800 text-gray-50 text-[14px] sm:text-xs">
                                <tr>
                                    <th class="px-2 sm:px-4 py-2 text-left">User ID</th>
                                    <th class="px-2 sm:px-4 py-2 text-left">Invoice Number</th>
                                    <th class="px-2 sm:px-4 py-2 text-left">Amount</th>
                                    <th class="px-2 sm:px-4 py-2 text-center">Name</th>
                                    <th class="px-2 sm:px-4 py-2 text-center">Phone</th>
                                    <th class="px-2 sm:px-4 py-2 text-center">Email</th>
                                    <th class="px-2 sm:px-4 py-2 text-center">Expired_at</th>
                                    <th class="px-2 sm:px-4 py-2 text-left">Description</th>
                                    <th class="px-2 sm:px-4 py-2 text-left">Notification Type</th>
                                    <th class="px-2 sm:px-4 py-2 text-left">Currency</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100 text-[14px] sm:text-xs">
                                <tr>
                                    <td class="px-2 sm:px-4 py-3 ">{{ Auth::user()->user_id }}</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">INO-816815</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">1000</td>
                                    <td class="px-2 sm:px-4 py-3 ">Htet Linn Aung</td>
                                    <td class="px-2 sm:px-4 py-3 ">09960231318</td>
                                    <td class="px-2 sm:px-4 py-3 ">htetlinn437@gmail.com</td>
                                    <td class="px-2 sm:px-4 py-3 ">2025-07-12T15:39</td>
                                    <td class="px-2 sm:px-4 py-3 ">Payment for July</td>
                                    <td class="px-2 sm:px-4 py-3 text-center ">Email</td>
                                    <td class="px-2 sm:px-4 py-3 ">MMK</td>
                                </tr>
                                <tr>
                                    <td class="px-2 sm:px-4 py-3 ">{{ Auth::user()->user_id }}</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">INO-816815</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">1000</td>
                                    <td class="px-2 sm:px-4 py-3 ">Htet Linn Aung</td>
                                    <td class="px-2 sm:px-4 py-3 ">09960231318</td>
                                    <td class="px-2 sm:px-4 py-3 ">htetlinn437@gmail.com</td>
                                    <td class="px-2 sm:px-4 py-3 ">2025-07-12T15:39</td>
                                    <td class="px-2 sm:px-4 py-3 ">Payment for July</td>
                                    <td class="px-2 sm:px-4 py-3 text-center ">Copy</td>
                                    <td class="px-2 sm:px-4 py-3 ">MMK</td>
                                </tr>
                                <tr>
                                    <td class="px-2 sm:px-4 py-3 ">{{ Auth::user()->user_id }}</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">INO-816815</td>
                                    <td class="px-2 sm:px-4 py-3 text-center">1000</td>
                                    <td class="px-2 sm:px-4 py-3 ">Htet Linn Aung</td>
                                    <td class="px-2 sm:px-4 py-3 ">09960231318</td>
                                    <td class="px-2 sm:px-4 py-3 ">htetlinn437@gmail.com</td>
                                    <td class="px-2 sm:px-4 py-3 ">2025-07-12T15:39</td>
                                    <td class="px-2 sm:px-4 py-3 ">Payment for July</td>
                                    <td class="px-2 sm:px-4 py-3 text-center ">Email</td>
                                    <td class="px-2 sm:px-4 py-3 ">MMK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div x-data="{
                        now: new Date(),
                        updateTime() {
                            this.now = new Date();
                        },
                        formatDateTime() {
                            const pad = n => n.toString().padStart(2, '0');
                            const y = this.now.getFullYear();
                            const m = pad(this.now.getMonth() + 1);
                            const d = pad(this.now.getDate());
                            const h = pad(this.now.getHours());
                            const min = pad(this.now.getMinutes());
                            return `${y}-${m}-${d}T${h}:${min}`;
                        }
                    }" x-init="setInterval(() => updateTime(), 1000)"
                        class="text-xs sm:text-sm font-semibold text-gray-700  mt-8">
                        Current Time with <code class="bg-gray-100 px-1 py-0.5 rounded">YYYY-MM-DDTHH:MM</code> format is
                        <span x-text="formatDateTime()" class="text-blue-500 text-xs"></span>
                    </div>
                </div>

                <!-- Upload Form Section -->
                <div class="mt-2 sm:mt-5">
                    <form action="{{ route('links.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col sm:flex-row items-stretch gap-4">
                        @csrf
                        <div class="relative flex-grow">
                            <!-- Custom file input container -->
                            <div class="relative">
                                <input required type="file" name="excel_file" accept=".xlsx,.xls,.csv" id="file-upload"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <label for="file-upload"
                                    class="flex items-center justify-between w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                    <span class="truncate">Choose a Excel file...</span>
                                    <span
                                        class="ml-2 px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">Browse</span>
                                </label>
                            </div>
                            <!-- Selected file name will appear here -->
                            <div id="file-name" class="mt-1 text-xs text-gray-500 truncate"></div>
                        </div>
                        <button id="upload-btn" type="submit"
                            class="flex-shrink-0 sm:w-auto bg-gray-800 hover:bg-gray-700 text-white px-5 py-3 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>

                            <span class="upload-text">Upload</span>

                            <!-- Spinner -->
                            <svg id="upload-spinner" class="hidden animate-spin h-5 w-5 ml-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 01-8 8z"></path>
                            </svg>
                        </button>

                    </form>
                    <p class="mt-2 text-xs text-gray-500">
                        Supported formats: .xlsx, .xls, .csv
                    </p>


                </div>
            </div>
            <div class="bg-gray-50 px-4 sm:px-6 py-4 border-t border-gray-200 rounded-lg mt-1">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center text-sm text-gray-500 space-y-2 md:space-y-0">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-6 mb-2 ">

                        <a href="{{ route('merchant.paywithlink') }}" class="text-gray-600 hover:text-gray-900   flex items-center">
                            <i class="fa-solid fa-arrow-left mr-2 mt-2"></i>
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3 ml-2">
                        <a id="btn-png" href="{{ Storage::url('common/Bundle_Format.xlsx') }}" download
                            class="flex items-center gap-2 bg-green-100 text-green-700 hover:bg-green-200 px-4 py-2 rounded-md transition">
                            <svg id="loading-png" class="hidden w-4 h-4 animate-spin text-green-700"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span id="text-png">Download Excel Format </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const fileName = document.getElementById('file-name');
            if (this.files.length > 0) {

                // Update the label text
                const label = document.querySelector('label[for="file-upload"] span:first-child');
                label.textContent = this.files[0].name;
                label.classList.remove('text-gray-700');
                label.classList.add('text-gray-900', 'font-medium');
            } else {
                fileName.textContent = '';
            }
        });
        const form = document.querySelector('form[action="{{ route('links.import') }}"]');
        const uploadBtn = document.getElementById('upload-btn');
        const spinner = document.getElementById('upload-spinner');
        const uploadText = uploadBtn.querySelector('.upload-text');

        form.addEventListener('submit', function() {
            uploadBtn.disabled = true;
            uploadText.classList.add('hidden');
            spinner.classList.remove('hidden');
        });
    </script>
@endsection

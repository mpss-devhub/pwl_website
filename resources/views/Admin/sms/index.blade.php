@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
            <!-- Main Form Card -->
            <div class="flex justify-end mr-2 ">
                <a href="{{ route('merchant.show') }}" class="py-1 px-4 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-colors duration-300 ">
                   <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 sm:p-6 mb-6 mt-4">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-700">SMS Gateway Settings</h3>
                          <div class="flex items-end">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-semibold mr-2">
                        Merchant ID: {{ $details['merchant_id'] }}
                    </span>
                    </div>
                </div>
                    <p class="text-xs sm:text-sm text-gray-500">Configure SMS sender details and API credentials</p>
                </div>

                <form action="{{ route('sms.create') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Sender Name Field -->
                    <div>
                        <label for="sender_name" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Sender Name</label>
                        <input type="text" id="sender_name" name="sender_name" placeholder="e.g. YourBusiness"
                            class="w-full px-3 sm:px-4 py-2 text-xs sm:text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            @if (!$sms->isEmpty()) value="{{ $sms[0]['sms_from'] }}" @endif
                            maxlength="11">
                    </div>

                    <!-- API Token Field -->
                    <div>
                        <label for="api_token" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">API Token</label>
                        <div class="relative">
                            <input type="password" id="api_token" name="api_token" placeholder="Enter your API key"
                                class="w-full px-3 sm:px-4 py-2 text-xs sm:text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 pr-8 sm:pr-10"
                                @if (!$sms->isEmpty()) value="{{ $sms[0]['sms_token'] }}" @endif>
                            <button type="button" onclick="togglePasswordVisibility('api_token')"
                                class="absolute inset-y-0 right-0 pr-2 sm:pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-eye text-sm sm:text-base"></i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="merchant_id" value="{{ $details['merchant_id'] }}">

                    <!-- Action Buttons - Stack on mobile, row on larger screens -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-2 sm:gap-3 pt-4 border-t border-gray-200">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-medium text-xs sm:text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i class="fa-solid fa-save mr-2 text-xs sm:text-sm"></i>
                            @if (!$sms->isEmpty()) Update @else Create @endif SMS Service
                        </button>

                        @if (!$sms->isEmpty())
                            <a href="{{ route('sms.delete', $sms[0]['id']) }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-medium text-xs sm:text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                onclick="return confirm('Are you sure you want to delete this SMS configuration?')">
                                <i class="fa-solid fa-trash-can mr-2 text-xs sm:text-sm"></i>
                                Remove Service
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endsection

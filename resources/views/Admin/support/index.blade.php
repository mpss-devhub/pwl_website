@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 ">
                    <div class="flex justify-between">
                        <div class="">
                            <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-20" alt="">
                        </div>
                        <div class="">
                            <p class="text-md font-semibold text-gray-800 mb-6 mx-2 "> Octoverse Announcement </p>
                        </div>

                    </div>
                    <hr>
                    <form action="{{ route('support.announcement') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-4">

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1"> Announcement
                                    Content
                                    @error('content')
                                        <span class="text-[12px] text-red-400 mx-3">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" name="content" id="name" value="{{ old('content') }}"
                                    placeholder="https://www.youtube.com/watch?v=..."
                                    class="placeholder-gray-400 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1"> Announcement
                                    Title
                                    @error('title')
                                        <span class="text-[12px] text-red-400 mx-3">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" name="title" id="name" required value="{{ old('title') }}"
                                    required placeholder="Enter Title"
                                    class="placeholder-gray-400 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1"> Announcement
                                    Letter
                                    @error('letter')
                                        <span class="text-[12px] text-red-400 mx-3">{{ $message }}</span>
                                    @enderror
                                </label>
                                <textarea type="text" name="letter" id="name" required cols="20" rows="5"
                                    value="{{ old('letter') }}" required required placeholder="Enter Message"
                                    class="placeholder-gray-400 w-full  border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                            </div>


                        </div>

                        <!-- Permissions Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sent this To
                                @error('merchant_id')
                                    <span class="text-[12px] text-red-400 mx-3">{{ $message }}</span>
                                @enderror
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                <div class="flex items-center">
                                    <input id="allMerchants" name="merchant_id" type="checkbox" value="all"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="allMerchants" class="ml-2 text-sm text-gray-700">
                                        All Merchants
                                    </label>
                                </div>

                                @if ($merchants->count() > 0)
                                    @foreach ($merchants as $item)
                                        <div class="flex items-center">
                                            <input id="merchant-{{ $item->user_id }}" name="merchant_id[]" type="checkbox"
                                                value="{{ $item->user_id }}"
                                                class="merchant h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="merchant-{{ $item->user_id }}" class="ml-2 text-sm text-gray-700">
                                                {{ $item->merchant_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('support.list') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" id="submit-btn"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Send Announcement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const allMerchants = document.getElementById("allMerchants");
            const merchantCheckboxes = document.querySelectorAll(".merchant");

            //  All Merchants
            allMerchants.addEventListener("change", function() {
                if (this.checked) {
                    merchantCheckboxes.forEach(cb => {
                        cb.checked = false;
                        cb.disabled = true;
                        cb.parentElement.classList.add("opacity-50", "cursor-not-allowed");
                    });
                } else {
                    merchantCheckboxes.forEach(cb => {
                        cb.disabled = false;
                        cb.parentElement.classList.remove("opacity-50", "cursor-not-allowed");
                    });
                }
            });

            //merchant  selected
            merchantCheckboxes.forEach(cb => {
                cb.addEventListener("change", function() {
                    if (this.checked) {
                        allMerchants.checked = false;
                        allMerchants.disabled = true;
                        allMerchants.parentElement.classList.add("opacity-50",
                            "cursor-not-allowed");
                    }
                    // If no merchant
                    if (![...merchantCheckboxes].some(c => c.checked)) {
                        allMerchants.disabled = false;
                        allMerchants.parentElement.classList.remove("opacity-50",
                            "cursor-not-allowed");
                    }
                });
            });
        });
    </script>
@endsection

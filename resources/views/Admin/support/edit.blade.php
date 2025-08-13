@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow overflow-hidden p-6">
                <h2 class="text-xl font-semibold mb-4">Edit Announcement</h2>

                <form action="{{ route('support.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 text-sm">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="letter">Letter</label>
                        <textarea name="letter" id="letter" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 text-sm">{{ old('letter', $announcement->letter) }}</textarea>
                        @error('letter')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="content">YouTube Link</label>
                        <input type="text" name="content" id="content"
                            value="{{ old('content', $announcement->content) }}"
                            placeholder="https://www.youtube.com/watch?v=..."
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 text-sm">
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Send this To</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            @php
                                $data = json_decode($announcement->merchant_id, true);
                            @endphp

                            <div class="flex items-center">
                                <input id="all-merchants" name="merchant_id" type="checkbox" value="all"
                                    @checked($announcement->merchant_id === '"all"')
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="all-merchants" class="ml-2 text-sm text-gray-700">
                                    All Merchants
                                </label>
                            </div>

                            @foreach ($merchants as $item)
                                <div class="flex items-center">
                                    <input id="merchant-{{ $item->user_id }}" name="merchant_id[]"
                                        @checked(is_array($data) && in_array($item->user_id, $data)) type="checkbox" value="{{ $item->user_id }}"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="merchant-{{ $item->user_id }}" class="ml-2 text-sm text-gray-700">
                                        {{ $item->merchant_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="created_by" value="{{ $announcement->created_by }}">

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('support.list') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

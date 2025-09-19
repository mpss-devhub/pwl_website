@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            @foreach ($users as $user)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-md font-semibold text-gray-800 mb-6">Update User Information</h2>

                    <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User ID Field -->
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User ID</label>
                                <input type="text" name="user_id" id="user_id" value="{{ $user->user_id }}" readonly
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100">
                            </div>

                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" required minlength="4" maxlength="12"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="on" @selected($user->status == 'on')>Active</option>
                                    <option value="off" @selected($user->status == 'off')>Inactive</option>
                                </select>
                            </div>

                            <!-- Created At -->
                            <div>
                                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                                <input type="text" name="" id="created_at" disabled
                                    value="{{ $user->created_at->format('d/m/Y') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100">
                            </div>
                        </div>

                     <!-- Permissions Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">User Group</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach ($permi as $item)
                                    <div class="flex items-center">
                                        <input id="permission-{{ $item->id }}" name="permission_id" type="radio"
                                            value="{{ $item->id }}" required
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            @checked($user->permission_id == $item->id) >
                                        <label for="permission-{{ $item->id }}" class="ml-2 text-sm text-gray-700">
                                            {{ $item->user_group }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <input type="hidden" name="password" value="{{ $user->password }}">

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('user.show') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-500">
                                Update User Info
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

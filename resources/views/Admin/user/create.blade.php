@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Create New User</h2>

                    <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" name="phone" id="phone"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Permissions Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">User Group</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach ($per as $item)
                                    <div class="flex items-center">
                                        <input id="permission-{{ $item->id }}" name="permission_id" type="radio"
                                            value="{{ $item->id }}" required
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-{{ $item->id }}" class="ml-2 text-sm text-gray-700">
                                            {{ $item->user_group }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Hidden Fields -->
                        <input type="hidden" id="user_id" name="user_id">
                        <input type="hidden" name="role" value="admin">
                        <input type="hidden" id="password" name="password">

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('user.show') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" id="submit-btn"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submit-btn');

            submitBtn.addEventListener('click', function(e) {
                // Generate User ID
                const name = document.getElementById('name').value.trim();
                if (!name) {
                    alert('Please enter a name');
                    e.preventDefault();
                    return;
                }

                const firstLetter = name.charAt(0).toUpperCase();
                const digits = Math.floor(1000 + Math.random() * 9000);
                const userId = 'OCT_' + firstLetter + digits;
                document.getElementById('user_id').value = userId;

                // Generate Password
                const nameForPassword = name.replace(/\s+/g, '');
                const passwordDigits = Math.floor(1000 + Math.random() * 9000).toString();
                const mixedChars = [...nameForPassword + passwordDigits]
                    .sort(() => Math.random() - 0.5)
                    .join('');
                document.getElementById('password').value = mixedChars;

                console.log('Generated User ID:', userId);
                console.log('Generated Password:', mixedChars);
            });
        });
    </script>
@endsection

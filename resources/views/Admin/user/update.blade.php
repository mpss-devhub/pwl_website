@extends('Admin.layouts.dashboard')
@section('admin_content')
    @foreach ($users as $user)
        <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
            <div class="p-4 mt-14">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">User Management</h2>

                        <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- User ID Field -->
                                <div>
                                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User
                                        ID</label>
                                    <input type="text" name="user_id" id="user_id" value="{{ $user->user_id }}"
                                        readonly
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                        Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <!-- Phone Field -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                        Number</label>
                                    <input type="tel" name="phone" id="phone" value="{{ $user->phone }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <!-- Status Field -->
                                <div>
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" id="status"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="active" @selected($user->status == 'active')>Active</option>
                                        <option value="inactive" @selected($user->status == 'inactive')>Inactive</option>

                                    </select>
                                </div>

                                <!-- Password -->
                                <div class="relative">
                                    <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">Created _at
                                    </label>
                                    <input type="text" name="" id="created_at" disabled
                                        value="{{ $user->created_at->format('d/m/Y') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                                </div>

                            </div>
                            <!-- Permissions Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">User Group</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    <div class="flex items-center">
                                        <input id="permission-create" name="permission_id" type="checkbox" value="1"
                                            @checked($user->permission_id == 1)
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-create" class="ml-2 text-sm text-gray-700">BD</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="permission-read" name="permission_id" type="checkbox" value="2"
                                            @checked($user->permission_id == 2)
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-read" class="ml-2 text-sm text-gray-700">HR</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="permission-update" name="permission_id" type="checkbox" value="3"
                                            @checked($user->permission_id == 3)
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-update" class="ml-2 text-sm text-gray-700">Finance</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="permission-delete" name="permission_id" type="checkbox" value="4"
                                            @checked($user->permission_id == 4)
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-delete" class="ml-2 text-sm text-gray-700">Developer</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" class="" id="" name="role" value="{{ $user->role }}"></input>
                            <input type="hidden" class="" id="password" name="password" value="{{ $user->password }}"></input>
                            <!-- Form  Actions -->
                            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                                <button type="button"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Cancel
                                </button>
                                <button type="submit" id='btn'
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update User Info
                                </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach

@endsection

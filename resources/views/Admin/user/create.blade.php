@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
        <div class="p-4 mt-14">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">User Management</h2>

                    <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                    Number</label>
                                <input type="tel" name="phone" id="phone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                                        <input id="permission-create" name="permission_id" type="checkbox" value="{{ $item->id }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="permission-create" class="ml-2 text-sm text-gray-700">{{ $item->user_group }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id"></input>
                        <input type="hidden" class="" id="" name="role" value="admin"></input>
                        <input type="hidden" class="" id="password" name="password"></input>
                        <!-- Form  Actions -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button type="button"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit" id='btn'
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create New User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            const userId = 'OCT_' + firstLetter + digits;

            document.getElementById('user_id').value = userId;
            console.log('Generated user_id:', userId);
        });
    </script>
@endsection

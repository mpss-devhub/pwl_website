@extends('Admin.layouts.dashboard')
@section('admin_content')
    @if (session('success') && session('user_id') && session('email') && session('password'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Download Credentials'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const content =
                            `User ID: {{ session('user_id') }}\nEmail: {{ session('email') }}\nPassword: {{ session('password') }}`;
                        const blob = new Blob([content], {
                            type: 'text/plain'
                        });
                        const link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.download = 'credentials.txt';
                        link.click();
                        URL.revokeObjectURL(link.href);
                    }
                });
            });
        </script>
    @elseif (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            @if (in_array('C', $access['U'] ?? []))
                <div class="flex justify-end">
                    <div
                        class="bg-gray-800 mx-2 text-white px-4 py-2 rounded-lg text-xs">
                        <a href="{{ route('user.create') }}" class="text-decoration-none">
                            <i class="fa-solid fa-user-plus mx-2"></i> Add User
                        </a>
                    </div>
                </div>
            @endif
            <!-- User Table Section -->
            <div class="bg-white rounded-lg shadow overflow-hidden mt-2">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    User ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    User Info
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    User Group
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($admins as $admin)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-center font-medium text-gray-900">
                                         {{ ($admins->currentPage() - 1) * $admins->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $admin->user_id }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                    src="{{ Storage::url('common/undraw_profile.svg') }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-xs text-center font-medium text-gray-900">{{ $admin->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ optional($admin->permission)->user_group }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $admin->phone }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-center text-gray-500">
                                        {{ $admin->email }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        @if ($admin->status == 'on')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-xs text-center font-medium">
                                        @if (in_array('U', $access['U'] ?? []))
                                            <a href="{{ route('user.show.update', $admin->id) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        @if (in_array('D', $access['U'] ?? []))
                                            <a href="{{ route('user.delete', $admin->id) }}"
                                                class="text-red-600 hover:text-red-900">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 ">
                    {{ $admins->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection

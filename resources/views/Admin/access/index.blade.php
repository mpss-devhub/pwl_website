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
        <div class="p-4 mt-12">

            <div class=" py-3 ">

                    <a href="{{  route ('access.create') }}">
                      <div class="flex justify-end ">
                          <div class="bg-gray-800 py-2 px-2 rounded text-white">
                              <i class="fa-solid fa-universal-access"></i>
                              New Permission
                          </div>

                      </div>
                    </a>

            </div>


            <!-- User Group -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    User Group
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Permission
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Allow Permissions
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    User Count
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Created At
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample Row 1 -->
                            @foreach ($p as $item)
                                 <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>

                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->user_group }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->permission }}</td>
                                 <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->allowed }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">11</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->created_at }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex  justify-end">

                        <div>
                            <nav class="relative  z-0 flex justify-between rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                15
                            </nav>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Empty State (optional) -->
            <!-- <div class="bg-white rounded-lg shadow p-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No SMS messages yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by sending your first SMS message.</p>
                            <div class="mt-6">
                                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    Send SMS
                                </a>
                            </div>
                        </div> -->
        </div>
    </div>
@endsection

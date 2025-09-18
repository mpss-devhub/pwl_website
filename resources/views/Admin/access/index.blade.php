@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-12">
            @if (in_array('C', $access['AA'] ?? []))
                <div class=" py-3 ">
                    <a href="{{ route('access.create') }}">
                        <div class="flex justify-end ">
                            <div class="bg-gray-800 py-2 px-3 rounded text-white">
                                <i class="fa-solid fa-users-gear mx-1"></i>
                              <span class="text-xs">Create User Group</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- User Group -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    User Group
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Permission
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Allow Permissions
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    User Count
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Created At
                                </th>
                                @if (in_array('U', $access['AA'] ?? []) || in_array('D', $access['AA'] ?? []))
                                      <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Actions
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample Row 1 -->
                            @foreach ($p as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-xs font-medium text-gray-900">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-center text-xs text-gray-500 max-w-xs truncate">
                                        <div class="text-xs font-medium text-gray-900">{{ $item->user_group }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs text-gray-500 max-w-xs truncate">{{ $item->permission }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs text-gray-500 max-w-xs truncate">{{ $item->allowed }}</td>
                                    <td class="px-6 py-4 text-center text-xs text-gray-500 max-w-xs truncate">
                                        {{ $item->users_count }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-xs text-gray-500">{{ $item->created_at }}
                                    </td>
                                    @if ($item->id !== 1 )
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-right text-xs font-medium">
                                        @if (in_array('U', $access['AA'] ?? []))
                                            <a href="{{ route('access.edit', $item->id) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        @if (in_array('D', $access['AA'] ?? []))
                                            <form action="{{ route('permissions.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-transparent border-none p-0 m-0">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

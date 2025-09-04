@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 mt-10 flex justify-center items-center min-h-screen bg-gray-200">
        <div class="w-full max-w-6xl  bg-gray-50 shadow-lg rounded-xl p-6 overflow-y-auto">
            <form method="POST" action="{{ route('access.store') }}" class="">
                @csrf
                <div class="">
                    <div class="">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-3">
                                <label for="user_group" class="text-sm font-medium text-gray-700">
                                    Group Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="user_group" id="user_group" required
                                    value="{{ old('user_group') }}" minlength="2" maxlength="30"
                                    class="w-72 p-2 border rounded-md border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400 text-sm">
                            </div>
                            <p class="text-md font-semibold text-gray-700  pr-4 pb-2 md:pb-0 mx-2">
                                Create New Permission Group
                            </p>

                        </div>

                    </div>
                    <hr class="my-3 border-gray-300">
                    <div>

                        <div class="space-y-2">
                            @php
                                $permissionGroups = [
                                    'T' => [
                                        'label' => 'Transaction',
                                        'actions' => ['E' => 'Export', 'P' => 'Payment Detail', 'TD' => 'Tnx Details'],
                                    ],
                                    'L' => [
                                        'label' => 'Links',
                                        'actions' => [
                                            'E' => 'Export',
                                            'R' => 'Resent',
                                            'V' => 'View',
                                            'U' => 'Updatae',
                                        ],
                                    ],
                                    'M' => [
                                        'label' => 'Merchant',
                                        'actions' => [
                                            'C' => 'Create',
                                            'U' => 'Update',
                                            'D' => 'Delete',
                                            'S' => 'SMS Setup',
                                            'I' => 'Info',
                                            'M' => 'MDR',
                                        ],
                                    ],
                                    'U' => [
                                        'label' => 'User',
                                        'actions' => ['C' => 'Create', 'U' => 'Update', 'D' => 'Delete'],
                                    ],
                                    'AA' => [
                                        'label' => 'Admin Access',
                                        'actions' => ['C' => 'Create', 'U' => 'Update', 'D' => 'Delete'],
                                    ],
                                    'AN' => [
                                        'label' => 'Announcement',
                                        'actions' => ['C' => 'Create', 'U' => 'Update', 'D' => 'Delete'],
                                    ],
                                    'S' => ['label' => 'Settlement', 'actions' => ['C' => 'Detail', 'E' => 'Export']],
                                ];
                            @endphp

                            @foreach ($permissionGroups as $code => $group)
                                <div class="max-w-5xl rounded-xl p-4 mb-4 module-container">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                        <div class="flex items-center justify-between bg-gray-50 cursor-pointer">
                                            <div class="flex items-center">
                                                <input id="module-{{ $code }}" type="checkbox"
                                                    class="module-toggle h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                                <label for="module-{{ $code }}"
                                                    class="ml-2 text-sm font-medium text-gray-700">
                                                    {{ $group['label'] }}
                                                </label>
                                            </div>
                                            <input type="checkbox" name="permission[]" value="{{ $code }}"
                                                class="module-checkbox hidden">
                                        </div>
                                        <div class="flex flex-wrap gap-3">
                                            @foreach ($group['actions'] as $actionCode => $actionLabel)
                                                <label for="allowed-{{ $code }}-{{ $actionCode }}"
                                                    class="flex items-center gap-2 px-3 py-1 rounded-lg border border-gray-200 text-sm cursor-pointer hover:bg-blue-50 transition">
                                                    <input id="allowed-{{ $code }}-{{ $actionCode }}"
                                                        name="allowed[{{ $code }}][]" type="checkbox"
                                                        value="{{ $actionCode }}"
                                                        class="action-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
                                                    <span class="text-gray-700 text-xs">{{ $actionLabel }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3 mt-auto">
                    <a href="{{ url()->previous() }}"
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-800 hover:bg-gray-300 text-center">
                        Cancel
                    </a>
                    <button type="submit"
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-900 hover:bg-blue-800 shadow">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

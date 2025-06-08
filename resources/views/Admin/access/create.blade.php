@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-12">
            <div class="shadow-lg bg-white py-8 px-12 rounded border ">
                <div class="">
                    Creating New Permission
                </div>
                <br>
                <div class="">
                    <form method="POST" action="{{ route('access.store') }}">
                        @csrf
                        <div class="mb-8">
                            <label for="user_group" class="block text-gray-700 font-semibold mb-2">Add New User Group</label>
                            <div class="">
                                <input type="text" name="user_group" class="rounded-md w-80">
                            </div>
                        </div>
                        @php
                            $permissionGroups = [
                                'T' => 'Transaction',
                                'U' => 'User',
                                'M' => 'Merchant',
                                'S' => 'SMS',
                                'AA' => 'Access',
                            ];
                            $actions = ['R' => 'Read', 'W' => 'Write', 'D' => 'Delete'];
                        @endphp

                        @foreach ($permissionGroups as $code => $label)
                            <div class="flex items-center flex-wrap mb-4 ">
                                <div class="w-full sm:w-1/3">
                                    <input id="permission-{{ $code }}" name="permission[]" type="checkbox"
                                        value="{{ $code }}"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="permission-{{ $code }}"
                                        class="ml-2 text-sm text-gray-700 font-semibold">{{ $label }}</label>
                                </div>
                                <div class="flex space-x-4 mt-2 sm:mt-0 sm:ml-4">
                                    @foreach ($actions as $actionCode => $actionLabel)
                                        <div>
                                            <input id="allowed-{{ $code }}-{{ $actionCode }}"
                                                name="allowed[{{ $code }}][]" type="checkbox"
                                                value="{{ $actionCode }}"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="allowed-{{ $code }}-{{ $actionCode }}"
                                                class="ml-1 text-sm text-gray-700">{{ $actionLabel }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Access
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

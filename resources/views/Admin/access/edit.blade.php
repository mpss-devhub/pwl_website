@extends('Admin.layouts.dashboard')
@section('admin_content')
<div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
    <div class="p-4 mt-14">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Edit Permission Group</h3>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Group Name -->
                    <div class="mb-8">
                        <label for="user_group" class="block text-sm font-medium text-gray-700 mb-2">
                            Group Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="user_group" id="user_group" required
                            class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                            value="{{ $permission->user_group }}">
                    </div>

                    <!-- Permissions -->
                    @php
                        $permissionGroups = ['T' => 'Transaction', 'U' => 'User', 'M' => 'Merchant', 'S' => 'SMS', 'AA' => 'Access'];
                        $actions = ['R' => 'Read', 'W' => 'Write', 'D' => 'Delete'];

                        $selectedPermissions = explode('-', $permission->permission);
                        $allowedParsed = [];

                        foreach (explode(';', $permission->allowed) as $group) {
                            [$key, $vals] = explode(':', $group);
                            $allowedParsed[$key] = explode(',', $vals);
                        }
                    @endphp

                    <div class="space-y-4">
                        <h4 class="text-md font-medium text-gray-700 mb-3">Module Permissions</h4>

                        @foreach($permissionGroups as $code => $label)
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Module -->
                            <div class="flex items-center justify-between bg-gray-50 px-4 py-3">
                                <div class="flex items-center">
                                    <input id="module-{{ $code }}" type="checkbox"
                                        class="module-toggle h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        {{ in_array($code, $selectedPermissions) ? 'checked' : '' }}>
                                    <label for="module-{{ $code }}" class="ml-2 text-sm font-medium text-gray-700">
                                        {{ $label }}
                                    </label>
                                </div>
                                <input type="checkbox" name="permission[]" value="{{ $code }}"
                                    class="module-checkbox hidden"
                                    {{ in_array($code, $selectedPermissions) ? 'checked' : '' }}>
                            </div>

                            <!-- Actions -->
                            <div class="module-actions {{ in_array($code, $selectedPermissions) ? '' : 'hidden' }} bg-gray-50 px-4 py-3 border-t border-gray-200">
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach($actions as $actionCode => $actionLabel)
                                    <div class="flex items-center">
                                        <input id="allowed-{{ $code }}-{{ $actionCode }}"
                                            name="allowed[{{ $code }}][]" type="checkbox"
                                            value="{{ $actionCode }}"
                                            class="action-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            {{ in_array($actionCode, $allowedParsed[$code] ?? []) ? 'checked' : '' }}>
                                        <label for="allowed-{{ $code }}-{{ $actionCode }}" class="ml-2 text-sm text-gray-700">
                                            {{ $actionLabel }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Submit -->
                    <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 mr-3">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            Update Permission Group
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.module-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const container = this.closest('.border');
            const actions = container.querySelector('.module-actions');
            const hiddenCheckbox = container.querySelector('.module-checkbox');

            if (this.checked) {
                actions.classList.remove('hidden');
                hiddenCheckbox.checked = true;
            } else {
                actions.classList.add('hidden');
                hiddenCheckbox.checked = false;
                actions.querySelectorAll('.action-checkbox').forEach(cb => cb.checked = false);
            }
        });
    });

    document.querySelectorAll('.action-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const container = this.closest('.border');
            const toggle = container.querySelector('.module-toggle');
            const hiddenCheckbox = container.querySelector('.module-checkbox');

            if (this.checked && !toggle.checked) {
                toggle.checked = true;
                hiddenCheckbox.checked = true;
                container.querySelector('.module-actions').classList.remove('hidden');
            }
        });
    });
});
</script>
@endsection

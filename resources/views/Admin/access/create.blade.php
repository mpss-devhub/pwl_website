@extends('Admin.layouts.dashboard')
@section('admin_content')
<div class="p-4 sm:ml-64 mt-14 flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-6xl aspect-[16/9] bg-white shadow-lg rounded-xl p-6 overflow-y-auto">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Create New Permission Group</h2>

        <form method="POST" action="{{ route('access.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf

            <!-- LEFT SIDE -->
            <div class="">
                <div class="">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia optio magni exercitationem ipsum vitae nemo, aliquid quam nobis perferendis, labore quisquam hic sequi ad possimus. Unde quo quod molestiae? Eligendi?
                </div>
              <div class="">
                  <div>
                    <label for="user_group" class="block text-sm font-medium text-gray-700 mb-2">
                        Group Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="user_group" id="user_group" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 pt-6 mt-auto">
                    <a href="{{ url()->previous() }}"
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-800 hover:bg-gray-300 text-center">
                        Cancel
                    </a>
                    <button type="submit"
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 shadow">
                        Save
                    </button>
                </div>
              </div>
            </div>

            <!-- RIGHT SIDE -->
            <div>
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Module Permissions</h4>

                <div class="space-y-4">
                    @php
                        $permissionGroups = [
                            'T' => ['label'=>'Transaction','actions'=>['E'=>'Excel','P'=>'Payment Detail','TD'=>'Tnx Details']],
                            'M' => ['label'=>'Merchant','actions'=>['C'=>'Create','U'=>'Update','D'=>'Delete','S'=>'SMS Setup','I'=>'Info','M'=>'MDR']],
                            'U' => ['label'=>'User','actions'=>['C'=>'Create','U'=>'Update','D'=>'Delete']],
                            'AA'=> ['label'=>'Admin Access','actions'=>['C'=>'Create','U'=>'Update','D'=>'Delete']],
                            'AN'=> ['label'=>'Announcement','actions'=>['C'=>'Create','U'=>'Update','D'=>'Delete']],
                        ];
                    @endphp

                    @foreach ($permissionGroups as $code => $group)
                        <div class="border border-gray-300 rounded-lg shadow-sm transition hover:shadow-md">
                            <div class="flex items-center justify-between bg-gray-50 px-4 py-3 cursor-pointer">
                                <div class="flex items-center">
                                    <input id="module-{{ $code }}" type="checkbox"
                                        class="module-toggle h-5 w-5 text-blue-600 focus:ring-blue-500 rounded">
                                    <label for="module-{{ $code }}" class="ml-2 text-sm font-medium text-gray-800">
                                        {{ $group['label'] }}
                                    </label>
                                </div>
                                <input type="checkbox" name="permission[]" value="{{ $code }}" class="module-checkbox hidden">
                            </div>

                            <div class="module-actions bg-gray-50 px-4 py-3 border-t border-gray-200
                                max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($group['actions'] as $actionCode => $actionLabel)
                                        <div class="flex items-center">
                                            <input id="allowed-{{ $code }}-{{ $actionCode }}"
                                                name="allowed[{{ $code }}][]" type="checkbox"
                                                value="{{ $actionCode }}"
                                                class="action-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 rounded">
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
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.module-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('change', function () {
            const moduleContainer = this.closest('.border');
            const actionsSection = moduleContainer.querySelector('.module-actions');
            const hiddenCheckbox = moduleContainer.querySelector('.module-checkbox');

            if (this.checked) {
                actionsSection.style.maxHeight = actionsSection.scrollHeight + "px";
                hiddenCheckbox.checked = true;
            } else {
                actionsSection.style.maxHeight = "0px";
                hiddenCheckbox.checked = false;
                actionsSection.querySelectorAll('.action-checkbox').forEach(cb => cb.checked = false);
            }
        });
    });

    // ✅ Auto-open section if action checkbox is clicked
    document.querySelectorAll('.action-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const moduleContainer = this.closest('.border');
            const moduleToggle = moduleContainer.querySelector('.module-toggle');
            const hiddenCheckbox = moduleContainer.querySelector('.module-checkbox');
            const actionsSection = moduleContainer.querySelector('.module-actions');

            if (this.checked && !moduleToggle.checked) {
                moduleToggle.checked = true;
                hiddenCheckbox.checked = true;
                actionsSection.style.maxHeight = actionsSection.scrollHeight + "px";
            }
        });
    });
});
</script>

@endsection

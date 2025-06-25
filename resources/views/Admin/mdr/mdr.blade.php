@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        Payment Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        Payment Logo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        Merchant MDR Fee Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        Merchant MDR Fee Rate ( % )
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                        Merchant MDR Fee Amount
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $counter = 1; @endphp

                                @php
                                    $paymentSources = [
                                        ['data' => $Ewallet, 'label' => 'E-wallet'],
                                        ['data' => $QR, 'label' => 'QR'],
                                        ['data' => $Web, 'label' => 'Web Payment'],
                                        ['data' => $L_C, 'label' => 'Local Card'],
                                        ['data' => $G_C, 'label' => 'Global Card'],
                                    ];
                                @endphp

                                @foreach ($paymentSources as $source)
                                    @foreach ($source['data'] as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $counter++ }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $source['label'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex space-x-2 items-center">
                                                    <img src="{{ $item['logo'] }}" alt="logo"
                                                        class="w-10 h-10 rounded-lg">
                                                    <div class="text-sm text-gray-900">
                                                        {{ strtoupper($item['paymentName']) }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $item['merchantMdrFeeType'] }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 text-center">{{ $item['merchantMdrFeeRate'] }} %</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 text-center">{{ $item['merchantMdrFeeAmount'] }} MMK</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <!--<div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of
                                                <span class="font-medium">10</span> results
                                            </p>
                                        </div>

                                    </div>
                                </div>-->
                </div>

            </div>
        @endsection

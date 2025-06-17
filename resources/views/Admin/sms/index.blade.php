@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Add SMS Service For This Merchant</h2>
                    <p class="mb-4">Manage <b>{{ $details['merchant_id'] }}</b> SMS settings and configurations.</p>
                    <form action="{{ route('sms.create') }}" method="POST">
                        @csrf
                        <input type="text" name="sender_name" placeholder="SMS Sender Name"
                            class="mb-4 p-2 border border-gray-300 rounded-lg w-full block"
                            @if (!$sms->isEmpty() )
                           value="{{ $sms[0]['sms_from'] }}"
                            @endif >

                        <input type="text" name="api_url" placeholder="Add API URL"
                            class="mb-4 p-2 border border-gray-300 rounded-lg w-full block"
                            @if (!$sms->isEmpty())
                                value="{{ $sms[0]['sms_url'] }}"
                            @endif >

                        <input type="text" name="api_token" placeholder="Add API Token"
                            class="mb-4 p-2 border border-gray-300 rounded-lg w-full block"
                            @if (!$sms->isEmpty() )
                                value="{{ $sms[0]['sms_token'] }}"
                            @endif >

                        <input type="hidden" name="merchant_id" value="{{ $details['merchant_id'] }}">
                        <div class="flex space-x-2">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-700">Add
                                New SMS</button>
                            @if (!$sms->isEmpty() )
                                <a href="{{ route('sms.delete', $sms[0]['id']) }}"
                                    class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded hover:bg-red-700">
                                    Delete SMS Service
                                    <i class="fa-solid fa-trash-can mx-2"></i>
                                </a>
                            @endif

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

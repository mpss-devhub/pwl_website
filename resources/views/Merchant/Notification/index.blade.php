@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200     min-h-screen">
        <div class="p-4 mt-16">
              <div class="">
                @foreach ($notifications as $item)
                    <div class="bg-white py-4 px-2 rounded-md shadow mt-4">
                       <a href="{{ route('merchant.notification.details',  encrypt($item->id)) }}" class="block">
                         <div class="flex justify-between align-content-center px-5  ">
                            <p class="mb-2 font-semibold">{{ $item->title }}</p>
                        </div>
                        <hr class="px-5">
                        <div class=" items-center align-content-center">
                            <p class="py-2 px-5 text-xs">{{ $item->letter }}</p>
                        </div>
                          </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

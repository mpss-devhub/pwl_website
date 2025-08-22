@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14 ">

            <div class="">
                @if (in_array('C', $access['AN'] ?? []))
                    <div class="flex justify-end">
                        <a href="{{ route('support.show') }}"
                        class="bg-gray-800 mx-2 text-white px-4 py-2 rounded-xl">
                      <i class="fa-solid fa-puzzle-piece "></i>
                      <span class="">Create New</span>
                    </a>
                    </div>
                @endif
                @foreach ($data as $item)
                    <div class="bg-white py-4 px-2 rounded-md shadow mt-4">
                        <a href="{{ route('support.details', $item->id) }}">
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

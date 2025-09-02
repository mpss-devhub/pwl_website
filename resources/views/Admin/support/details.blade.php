@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow overflow-hidden p-4">
                @foreach ($data as $item)
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-md font-semibold mb-2">{{ $item->title }}</p>
                        <div class="">
                            <img src="{{ Storage::url('common/octoverse-logo.png') }}" width="80" alt="">
                        </div>
                    </div>
                    <hr>
                    <div class="flex justify-between  mt-4 text-gray-700 text-sm">
                        <div class="px-7">By : OCT_L025151</div>
                        <div class="px-7">
                            Created : {{ $item->created_at->format('Y-m-d') }}
                        </div>

                    </div>
                    <div class="flex flex-wrap justify-evenly">
                        @if ($item->content)
                            @php
                                $youtubeLink = str_replace('watch?v=', 'embed/', $item->content);
                                $youtubeLink = str_replace('youtu.be/', 'www.youtube.com/embed/', $youtubeLink);
                            @endphp
                            <div class="w-full md:w-1/2 flex justify-center mb-4 md:mb-0">

                                <iframe width="420" height="250" class="rounded mt-5" src="{{ $youtubeLink }}"
                                    frameborder="0" allowfullscreen></iframe>

                            </div>
                            <div class="w-full md:w-1/2 flex mt-5  ">
                                <p class="text-gray-700 text-sm px-10 ">{{ $item->letter }}</p>
                            </div>
                        @else
                            <div class="w-full mt-3">
                                <p class="text-gray-700 text-sm px-3 py-1">{{ $item->letter }}</p>
                            </div>
                        @endif
                    </div>

                    <p class="mt-12  text-sm text-gray-500">
                        To Merchants:
                        @php
                            $merchants = json_decode($item->merchant_id, true); // array
                        @endphp

                        @if (is_array($merchants))
                            @foreach ($merchants as $merchant)
                                <span class="px-2 py-1 bg-gray-200 rounded">{{ $merchant }}</span>
                            @endforeach
                        @else
                            <span class="px-2 py-1 bg-gray-200 rounded">All Merchants</span>
                        @endif
                    </p>
                    <hr class="my-4">
                @endforeach
            </div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('support.list') }}"
                class="bg-gray-800 mx-2 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">
                Back to List
            </a>

            @if (in_array('U', $access['AN'] ?? []))
                <a href="{{ route('support.edit', $data[0]['id']) }}"
                class="bg-gray-800 mx-2 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">
                <i class="fa-solid fa-pen-to-square mx-1"></i> Edit Announcement
                </a>
            @endif
                @if (in_array('D', $access['AN'] ?? []))
                    <a href="{{ route('support.delete', $data[0]['id']) }}"
                    class="bg-gray-800 mx-2 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">
                    <i class="fa-solid fa-delete-left mx-1"></i> Delete Announcement
                </a>
                @endif

        </div>
    </div>
@endsection

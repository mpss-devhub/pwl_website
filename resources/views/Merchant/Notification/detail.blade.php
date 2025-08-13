@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-16">
              <div class="flex justify-end mr-10 ">
                <a href="{{ route('merchant.notification') }}" class="py-1 px-4 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-colors duration-300 ">
                   <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <div class="max-w-6xl mx-auto mt-4">
                @foreach ($notification as $item)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden mb-6 transition-all duration-300 hover:shadow-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-md font-semibold text-gray-800">{{ $item->title }}</h2>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Created: {{ $item->created_at->format('F j, Y') }}
                                    </p>
                                </div>
                                <div class=" rounded-lg">
                                    <img src="{{ Storage::url('common/octoverse-logo.png') }}" width="110"
                                        alt="Octoverse Logo" class="h-10">
                                </div>
                            </div>

                            <div class="border-t border-gray-200 my-4"></div>
                            <div class="flex flex-col lg:flex-row gap-8 mt-6">
                                @if ($item->content)
                                    @php
                                        $youtubeLink = str_replace('watch?v=', 'embed/', $item->content);
                                        $youtubeLink = str_replace('youtu.be/', 'www.youtube.com/embed/', $youtubeLink);
                                    @endphp
                                    <div class="lg:w-1/2">
                                        <div class="rounded-lg overflow-hidden shadow-sm mx-5">
                                            <iframe class="w-full" height="250"  src="{{ $youtubeLink }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="lg:w-1/2">
                                        <div class=" p-4 rounded-lg h-full text-sm">
                                                <div class="font-semibold text-md">{{$item->title}}</div>
                                            <p class="text-gray-700 leading-relaxed whitespace-pre-line mt-4">{{ $item->letter }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full">
                                        <div class=" p-4 rounded-lg text-sm">
                                                <div class="font-semibold text-md">{{$item->title}}</div>
                                            <p class="text-gray-700 leading-relaxed whitespace-pre-line mt-4">{{ $item->letter }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-8 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">To Merchant:</span>
                                    <span class="px-3 py-1 bg-blue-100 text-gray-700 text-sm  rounded-full">
                                        {{ Auth::user()->user_id }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

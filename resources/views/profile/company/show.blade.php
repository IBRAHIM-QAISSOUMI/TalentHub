@extends('layouts.app')

@section('title', 'Compsny profile')

@section('content')
    <div class=" py-8 ">

        <!-- main -->
        <main class="h-full max-w-5xl mx-auto px-4 flex gap-x-8">

            <!-- left side -->
            <div class="w-2/3">

                <!-- header card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden pb-6">

                    <!-- gradient header -->
                    <div class="h-32 bg-gradient-to-r  from-blue-950 to-blue-800"></div>

                    <div class="relative px-6 pb-6 h-16 flex">

                        <!-- avatar -->
                        <div
                            class="absolute -top-10 w-20 h-20 flex items-center justify-between bg-white border border-gray-200 shadow-md rounded-2xl ">
                            @if ($company->logo)
                                <img id="logo-preview" src="{{ asset('storage/' . $company->logo) }}" alt="Logo"
                                    class="w-full h-full object-cover">
                            @else
                                <svg id="logo-placeholder" xmlns="http://www.w3.org/2000/svg"
                                    class="w-9 h-9 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15" />
                                </svg>
                                <img id="logo-preview" src="" alt="Logo"
                                    class="w-full h-full object-cover hidden">
                            @endif
                        </div>

                        <!-- actions buttons -->
                        <div class="ml-auto mt-2 flex flex-row-reverse gap-3">
                            @if (auth()->user()->id === $company->user->id)
                                <a href="{{ route('company.edit') }}"
                                    class="flex items-center gap-1.5 text-xs px-3 py-2 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z" />
                                    </svg>
                                    Edit profile
                                </a>
                            @else
                                <button
                                    class="flex items-center gap-1.5 text-xs px-3 py-2 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition ">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>

                                    Follow
                                </button>
                            @endif
                        </div>
                        <!-- end actions buttons -->

                    </div>

                    <!-- identity -->
                    <div class="px-6">
                        <h2 class="text-xl font-semibold text-gray-900 capitalize">{{ $company->name }}</h2>
                        <p class="text-sm text-gray-600 capitalize">
                            {{ $company->industry }} -
                            {{ $company->city }}, {{ $company->country }}
                        </p>
                        <div class="flex gap-3 text-xs text-gray-500 my-1.5">

                            <!-- ==================== -->
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                {{ $company->size }}
                            </span>

                            <!-- ==================== -->
                            @if ($company->website)
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>
                                    {{ $company->website }}
                                </span>
                            @endif

                            <!-- ==================== -->
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                1,204 followers
                            </span>
                        </div>

                        <!-- bio -->
                        <p class="text-sm text-gray-700 leading-relaxed mt-4">{{ $company->description }}</p>
                    </div>
                    <!-- end identity -->

                </div>
                <!-- end header card -->

                <!-- job card -->
                <span
                    class="block text-blue-600 text-sm font-semibold w-fit px-4 pb-1  mt-4 border-b-2 border-blue-600">Jobs({{ $company->jobOffers->count() }})</span>
                <div class="border-b border-gray-300"></div>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm px-6 py-5 mt-4">

                    <!-- mini card job -->
                    @if ($company->jobOffers->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            No job offers available.
                        </div>
                    @else
                        <h2 class="text-base font-semibold text-gray-800">Open positions</h2>
                        @foreach ($company->jobOffers as $job)
                            @if ($loop->index == 3)
                                @break
                            @endif
                            <div
                                class="flex mt-3 pb-2.5 gap-x-3 items-center {{ $loop->index < 2 ? 'border-b border-gray-200' : '' }}">

                                <!-- avatar -->
                                <div class="w-10 h-10 flex items-center bg-blue-100 border border-gray-200 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-700 mx-auto"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                    </svg>
                                </div>

                                <!-- details -->
                                <div>
                                    <p class="text-sm text-gray-700">{{ $job->title }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ $job->location }} - {{ $job->contract_type }} - {{$job->work_mode}}</p>
                                </div>

                                <!-- buttons -->
                                @if (auth()->user()->hasRole('recruiter'))
                                    <a href="{{route('jobs.show', $job->id)}}"
                                        class="ml-auto text-xs px-3 py-1 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition">
                                        View
                                    </a>
                                @else
                                    <a href=""
                                        class="ml-auto text-xs px-3 py-1 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition">
                                        Apply
                                    </a>
                                @endif


                            </div>
                        @endforeach

                        <a href="{{route('jobs.index', ['id' => $company->id])}}"
                            class="block mt-5 w-full text-sm text-center px-3 py-2 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition">
                            View all {{ $company->jobOffers->count() }} jobs
                        </a>
                    @endif
                    <!-- end mini card job -->

                </div>
                <!-- end job card -->

            </div>
            <!-- end left side -->

            <!-- right side  -->
            <div class="w-1/3 space-y-4">
                <!-- company info card -->
                <div class="bg-white border bordre-gray-200 rounded-2xl shadow-sm px-6 py-5">
                    <h2 class="text-base font-semibold text-gray-800 mb-3">Company Info</h2>

                    <div class="flex items-center gap-x-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        <span class="text-xs text-gray-600">{{$company->industry}}</span>
                    </div>

                    <div class="flex items-center gap-x-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <span class="text-xs text-gray-600">{{$company->city}}, {{$company->country}}</span>
                    </div>

                    <div class="flex items-center gap-x-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>

                        <span class="text-xs text-gray-600">Founded {{$company->created_at->format('Y')}}</span>
                    </div>
                </div>
                <!-- end company info card -->
            </div>
            <!-- end right side  -->
        </main>
        <!-- end main -->


    </div>
@endsection

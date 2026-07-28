@extends('layouts.app')

@section('title', 'My applications')

@section('content')
    <div class="py-8">
        <!-- main -->
         <div class="max-w-3xl mx-auto px-4 space-y-4">

            <!------------------------------- UI CANDIDATE ------------------------------->
            @if(auth()->user()->hasRole('candidate'))
            <div>
                <h1 class="text-xl text-gray-800 font-semibold">My applications</h1>
                <p class="text-sm text-gray-700 ">Track all your job applications</p>
            </div>

            <!-- status -->
            <div class="flex gap-x-4">
                <div class="w-full bg-white border border-gray-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Total</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$totalApp}}</span>
                </div>
                
                <div class="w-full bg-orange-50 border border-amber-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Pending</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$totalAppPending}}</span>
                </div>

                <div class="w-full bg-green-50 border border-green-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Accepted</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$totalAppAccepted}}</span>
                </div>
            </div>
            <!-- end status -->
            
            <!-- clean filter in applicatins with livewire -->
            <livewire:applications-filter/>

            <!------------------------------- END UI CANDIDATE ------------------------------->

            <!------------------------------- UI COMPANY ------------------------------->
            @else
            <div>
                <h1 class="text-lg sm:text-xl text-gray-800 font-semibold">Applications received</h1>
                <p class="text-sm text-gray-700 truncate">{{$jobs[0]->company->name}}</p>
            </div>
            
            <!-- status - responsive grid -->
            <div class="grid grid-cols-3 gap-2 sm:gap-4">
                <div class="bg-white border border-gray-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                    <span class="text-[10px] sm:text-xs text-gray-600">Total</span>
                    <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$totalApplications}}</span>
                </div>
                
                <div class="bg-amber-50 border border-amber-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                    <span class="text-[10px] sm:text-xs text-gray-600">Pending</span>
                    <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$pending}}</span>
                </div>
            
                <div class="bg-green-50 border border-green-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                    <span class="text-[10px] sm:text-xs text-gray-600">Accepted</span>
                    <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$accepted}}</span>
                </div>
            </div>
            <!-- end status -->
            
            @foreach($jobs as $job)
            
            <!-- Card -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            
                <!-- top card -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-3 sm:px-6 py-4 sm:py-5 bg-gradient-to-r from-gray-100 to-white border-b border-gray-200 gap-3 sm:gap-0">
            
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <!-- image -->
                        <div class="flex items-center justify-center h-10 w-10 bg-white border border-gray-200 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
            
                        <!-- details -->
                        <div class="min-w-0 flex-1 sm:flex-none">
                            <h3 class="text-sm text-gray-800 font-medium capitalize truncate">{{$job->title}}</h3>
                            <span class="flex flex-wrap items-center gap-x-0.5 text-gray-500 text-xs mt-0.5 capitalize">
                                <span class="truncate max-w-[100px] sm:max-w-none">{{$job->location}}</span>
                                <span class="hidden xs:inline">-</span>
                                <span class="truncate">{{$job->contract_type}}</span>
                                <span class="hidden xs:inline">-</span>
                                <span class="truncate">{{$job->work_mode}}</span>
                            </span>
                        </div>
                    </div>
            
                    <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto justify-between sm:justify-end">
                        <!-- status -->
                        <span class="text-[10px] sm:text-xs font-medium capitalize rounded-lg px-1.5 sm:px-2 py-0.5
                            {{ $job->is_closed ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}}"
                            >{{$job->is_closed ? 'Closed' : 'Open'}}</span>
            
                        <span class="text-[10px] sm:text-xs text-gray-600 whitespace-nowrap">{{$job->applications->count()}} applications</span>
                    </div>
            
                </div>
                <!-- end top card -->
            
                <!-- middle card - GRID 2 COLUMNS -->
                <div class="grid grid-cols-1 md:grid-cols-2 bg-white divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    @foreach($job->applications as $index => $application)
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-3 sm:px-4 py-3 sm:py-4 gap-2 sm:gap-0 
                        {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }}
                        {{ !$loop->last && $index % 2 == 0 ? 'border-b border-gray-100 md:border-b-0' : '' }}
                        {{ $loop->last && $index % 2 == 0 ? 'md:border-b-0' : '' }}">
            
                        <div class="flex items-center gap-2 sm:gap-3 pl-0 sm:pl-3 border-l-4
                            {{$application->status === 'pending' ? 'border-l-amber-500' : ''}}
                            {{$application->status === 'accepted' ? 'border-l-green-500' : ''}}
                            {{$application->status === 'rejected' ? 'border-l-red-500' : ''}}
                            min-w-0 w-full">
                            
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-blue-100 flex items-center justify-center shadow flex-shrink-0">
                                <span class="text-blue-700 text-xs sm:text-sm font-medium">
                                    {{ strtoupper(substr($application->user->name, 0, 2)) }}
                                </span>
                            </div>
            
                            <div class="min-w-0 flex-1">
                                <h3 class="text-xs sm:text-sm text-gray-800 font-medium capitalize truncate">{{$application->user->name}}</h3>
                                <p class="text-[10px] sm:text-xs text-gray-600">Applied {{$application->created_at->format('M d')}}</p>
                            </div>
                        </div>
            
                        <div class="flex items-center gap-2 sm:gap-3 ml-auto sm:ml-0 pl-0 sm:pl-0 w-full sm:w-auto justify-end">
                            <span class="text-[10px] sm:text-xs font-medium capitalize rounded-lg px-1.5 sm:px-2 py-0.5 whitespace-nowrap
                                {{ $application->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                {{ $application->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{$application->status}}
                            </span>
                            
                            <a href="{{route('candidate.show', $application->user->id)}}"
                               class="block border border-gray-300 p-1 sm:p-1.5 rounded-lg text-gray-700 hover:bg-gray-50 transition flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                        </div>
            
                    </div>
                    @endforeach
                </div>
                <!-- end middle card -->
            
                <!-- bottom card -->
                <div class="bg-gray-50 px-3 sm:px-6 py-3 sm:py-4 border-t border-gray-100">
                    <a href="{{route('job-applications', $job->id)}}"
                       class="flex items-center gap-1 text-xs sm:text-sm text-gray-700 hover:text-gray-900 transition w-full sm:w-auto justify-center sm:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        View all {{$job->applications->count()}} applications 
                    </a>
                </div>         
                <!-- end bottom card -->
            
            </div>
            <!-- End Card -->
            @endforeach
            
            @endif
            <!------------------------------- END UI COMPANY ------------------------------->
        </div>
        <!-- end main -->
    </div>
@endsection
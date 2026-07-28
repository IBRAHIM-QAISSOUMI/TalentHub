@extends('layouts.app')

@section('title', 'My applications')

@section('content')

<div class="py-4 sm:py-6 md:py-8 px-2 sm:px-0">

    <!-- main -->
    <div class="max-w-3xl mx-auto px-2 sm:px-4 space-y-4">
            
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Header -->
        <div class="flex flex-col xs:flex-row items-start xs:items-center gap-2 xs:gap-3">
            <div class="flex items-center gap-x-1">
                <a href="{{ url()->previous() }}" class="hover:opacity-70 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-lg sm:text-xl text-gray-800 font-semibold">Applications</h1>
            </div>
            <p class="text-xs sm:text-sm text-gray-700 truncate max-w-[200px] xs:max-w-none">{{$job->title}} - {{$job->company->name}}</p>
        </div>

        <!-- status cards - responsive grid -->
        <div class="grid grid-cols-3 gap-2 sm:gap-4">
            
            <div class="bg-gray-50 border border-gray-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                <span class="text-[10px] sm:text-xs text-gray-600">Total</span>
                <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$job->applications->count()}}</span>
            </div>
            
            <div class="bg-amber-50 border border-amber-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                <span class="text-[10px] sm:text-xs text-gray-600">Pending</span>
                <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$job->applications->where('status', 'pending')->count()}}</span>
            </div>
            
            <div class="bg-green-50 border border-green-200 px-2 sm:px-4 py-2.5 sm:py-3 rounded-lg shadow-sm">
                <span class="text-[10px] sm:text-xs text-gray-600">Accepted</span>
                <span class="block text-gray-900 text-base sm:text-xl font-semibold">{{$job->applications->where('status', 'accepted')->count()}}</span>
            </div>
        </div>
        <!-- end status -->

        <!-- list applications - grid for multiple columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            @foreach($job->applications as $application)
                <div class="bg-white border border-gray-300 rounded-lg px-3 sm:px-4 md:px-5 py-4 sm:py-5 overflow-hidden transition hover:shadow-md">
                    
                    <!-- top card -->
                    <div class="flex flex-col xs:flex-row justify-between items-start xs:items-center gap-2 xs:gap-0">

                        <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-blue-100 flex items-center justify-center shadow flex-shrink-0">
                                <span class="text-blue-700 text-xs sm:text-sm font-medium">
                                    {{ strtoupper(substr($application->user->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-xs sm:text-sm text-gray-800 font-medium capitalize truncate">{{$application->user->name}}</h3>
                                <p class="text-[10px] sm:text-xs text-gray-600 truncate">{{$application->user->email}}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 sm:gap-3 flex-shrink-0 ml-auto xs:ml-0">
                            <span class="text-[10px] sm:text-xs text-gray-600 whitespace-nowrap">{{$application->created_at->format('M d')}}</span>

                            <span class="text-[10px] sm:text-xs font-medium capitalize rounded-lg px-1.5 sm:px-2 py-0.5 whitespace-nowrap
                                {{ $application->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                {{ $application->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{$application->status}}
                            </span>

                            <a href="{{route('candidate.show', $application->user->id)}}"
                               class="block border border-gray-300 p-1 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- end top card -->

                    <!-- bottom - cover letter -->
                    <div class="border-t border-gray-200 mt-3 sm:mt-4 pt-3 sm:pt-4">
                        <span class="block text-[10px] sm:text-xs font-medium mb-1 uppercase text-gray-500 tracking-wide">Cover letter</span>
                        <div class="text-xs sm:text-sm text-gray-800 leading-relaxed line-clamp-3">{{$application->cover_letter}}</div>
                    </div>

                    <!-- action buttons -->
                    <div class="flex flex-col xs:flex-row justify-between gap-2 border-t border-gray-200 mt-3 sm:mt-4 pt-3 sm:pt-4">
                        
                        <form method="post" action="{{route('application.reject', $application)}}" class="w-full xs:w-auto">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full xs:w-auto flex items-center justify-center gap-x-1 text-xs sm:text-sm px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg border border-red-400 text-red-600 hover:bg-red-400 hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Reject
                            </button>
                        </form>

                        <form method="post" action="{{route('application.accept', $application)}}" class="w-full xs:w-auto">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full xs:w-auto flex items-center justify-center gap-x-1 text-xs sm:text-sm px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg border border-green-400 text-green-600 hover:bg-green-400 hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                Accept
                            </button>
                        </form>
                    </div>
                    <!-- end action buttons -->
                </div>
            @endforeach
        </div>
        <!-- end list applications -->
        
        <!-- Empty state -->
        @if($job->applications->isEmpty())
            <div class="text-center py-8 sm:py-12 text-gray-500 text-sm sm:text-base bg-white border border-gray-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 sm:size-12 mx-auto text-gray-300 mb-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <p>No applications for this job yet.</p>
            </div>
        @endif
    </div>
    <!-- end main -->

</div>

@endsection
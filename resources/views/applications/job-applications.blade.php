@extends('layouts.app')

@section('title', 'My applications')

@section('content')

<div class="py-8">

    <!-- main -->
    <div class="max-w-3xl mx-auto px-4 space-y-4">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
        <div class="items-center gap-3">
            <div class="flex items-center gap-x-1">
                <a href="{{ url()->previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-xl text-gray-800 font-semibold">Applications</h1>
            </div>
            <p class="text-sm text-gray-700 pl-6 pt-1">{{$job->title}} - {{$job->company->name}}</p>
        </div>

        <!-- status -->
        <div class="flex gap-x-4">
            <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                <span class="text-xs text-gray-600">Total</span>
                <span class="block text-gray-900 text-xl font-semibold">{{$job->applications->count()}}</span>
            </div>
            
            <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                <span class="text-xs text-gray-600">Pending</span>
                <span class="block text-gray-900 text-xl font-semibold">{{$job->applications->where('status', 'pending')->count()}}</span>
            </div>
            <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                <span class="text-xs text-gray-600">Accepted</span>
                <span class="block text-gray-900 text-xl font-semibold">{{$job->applications->where('status', 'accepted')->count()}}</span>
            </div>
        </div>
        <!-- end status -->

        <!-- list applications -->
         @foreach($job->applications as $application)
            <div class="bg-white border border-gray-300 rounded-lg px-6 py-5 overflow-hidden">
                
                <!-- top card -->
                <div class="flex justify-between items-center ">

                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shadow">
                            <span class="text-blue-700 text-md">
                                 {{ strtoupper(substr($application->user->name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-800 font-medium capitalize">{{$application->user->name}}</h3>
                            <p class="text-xs text-gray-600">{{$application->user->email}}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600">{{$application->created_at->format('M d')}}</span>

                        <span class="text-xs font-medium capitalize rounded-lg px-2 py-0.5
                            {{ $application->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $application->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $application->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}"
                            >{{$application->status}}
                        </span>

                        <a href="{{route('candidate.show', $application->user->id)}}"
                           class="block border border-gray-300 p-1.5 rounded-lg text-gray-700 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- end top card -->

                <!-- buttom -->
                <div class="border-t border-gray-200 mt-4 pt-4">
                    <span class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">Cover letter</span>
                    <div class="text-sm text-gray-800 leading-relaxed">{{$application->cover_letter}}</div>
                </div>

                <div class="flex justify-between border-t border-gray-200 mt-4 pt-4">
                    
                    <form method="post" action="{{route('application.reject', $application)}}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="flex items-center gap-x-1 text-sm px-4 py-2 rounded-lg border border-red-400 text-red-600 hover:bg-red-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Reject
                        </button>
                    </form>

                    <form method="post" action="{{route('application.accept', $application)}}">
                        @csrf
                        @method('PATCH')
                        <button class="flex items-center gap-x-1 text-sm px-4 py-2 rounded-lg border border-green-400 text-green-600 hover:bg-green-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Accept
                        </button>
                    </form>
                </div>
                <!-- end buttom -->
            </div>
         @endforeach
        <!-- end list applications -->
    </div>
    <!-- end main -->

</div>

@endsection
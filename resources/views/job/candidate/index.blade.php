@extends('layouts.app')

@section('title', 'Jobs')

@section('content')

    <div class="py-8">

        <!-- main -->
         <div class="max-w-3xl mx-auto px-4 space-y-6">
            <div>
                <h1 class="text-xl text-gray-800 font-semibold">Browse jobs</h1>
                <p class="text-sm text-gray-700">{{$jobs->count()}} offers available</p>
            </div>
            <livewire:jobs-search />
         </div>
        <!-- end main -->
    </div>

@endsection
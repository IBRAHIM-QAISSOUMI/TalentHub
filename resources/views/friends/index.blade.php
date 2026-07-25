@extends('layouts.app')

@section('title', 'friends request')

@section('content')

    <div class="py-8">
        
        <!-- main -->
        <div class="max-w-3xl mx-auto px-4 space-y-4">
            <livewire:friends-listings />

        </div>
    </div>
@endsection
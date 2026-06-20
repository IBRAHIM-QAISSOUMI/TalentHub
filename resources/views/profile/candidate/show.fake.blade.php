{{-- resources/views/candidate/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 space-y-4">

        {{-- ==================== HEADER CARD ==================== --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">

            {{-- Cover photo --}}
            <div class="h-32 bg-gradient-to-r from-blue-600 to-teal-500"></div>

            <div class="px-6 pb-6 relative">

                {{-- Avatar --}}
                <div class="absolute -top-14 left-6">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}"
                             alt="{{ $profile->name }}"
                             class="w-28 h-28 rounded-full border-4 border-white object-cover shadow">
                    @else
                        <div class="w-28 h-28 rounded-full border-4 border-white bg-blue-100 flex items-center justify-center shadow">
                            <span class="text-blue-700 font-semibold text-xl">
                                {{ strtoupper(substr($profile->name, 0, 2)) }}
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Action buttons --}}
                <div class="flex justify-end pt-3 gap-2 flex-wrap">
                    @if($profile->cv)
                        <a href="{{ asset('storage/' . $profile->cv) }}"
                           target="_blank"
                           class="inline-flex items-center gap-1.5 text-sm border border-gray-200 rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-8m0 8l-3-3m3 3l3-3M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2"/>
                            </svg>
                            Download CV
                        </a>
                    @endif
                    <a href="{{ route('candidate.edit') }}"
                       class="inline-flex items-center gap-1.5 text-sm bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                        </svg>
                        Edit profile
                    </a>
                </div>

                {{-- Identity --}}
                <div class="mt-8">
                    <h1 class="text-xl font-semibold text-gray-900">{{ auth()->user()->name }}</h1>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $profile->title }}</p>
                    <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                        {{ $profile->city }}, {{ $profile->country }}
                    </p>
                </div>

                {{-- Bio --}}
                <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                    {{ $profile->bio }}
                </p>

            </div>
        </div>


        {{-- ==================== SKILLS ==================== --}}
        @if($profile->skills->count())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-gray-800">Skills</h2>
                <a href="{{ route('candidate.edit') }}" class="text-gray-400 hover:text-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                    </svg>
                </a>
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach($profile->skills as $skill)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>

        </div>
        @endif


        {{-- ==================== EXPERIENCE ==================== --}}
        @if($profile->experiences->count())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-gray-800">Experience</h2>
                <a href="{{ route('candidate.edit') }}" class="text-gray-400 hover:text-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                    </svg>
                </a>
            </div>

            <div class="space-y-5">
                @foreach($profile->experiences as $index => $exp)

                    @if($index > 0)
                        <div class="border-t border-gray-100"></div>
                    @endif

                    <div class="flex gap-4 items-start">
                        {{-- Icon --}}
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15"/>
                            </svg>
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $exp->position }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $exp->company }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '—' }}
                                —
                                {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Present' }}
                            </p>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
        @endif


        {{-- ==================== EDUCATION ==================== --}}
        @if($profile->educations->count())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-gray-800">Education</h2>
                <a href="{{ route('candidate.edit') }}" class="text-gray-400 hover:text-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                    </svg>
                </a>
            </div>

            <div class="space-y-5">
                @foreach($profile->educations as $index => $edu)

                    @if($index > 0)
                        <div class="border-t border-gray-100"></div>
                    @endif

                    <div class="flex gap-4 items-start">
                        {{-- Icon --}}
                        <div class="w-9 h-9 rounded-lg bg-pink-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z"/>
                            </svg>
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $edu->degree }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $edu->school }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $edu->start_year }}
                                —
                                {{ $edu->end_year }}
                            </p>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
        @endif


        {{-- ==================== PROFILE COMPLETION ==================== --}}
        @php
            $fields = ['avatar', 'name', 'title', 'country', 'city', 'bio', 'cv'];
            $filled = collect($fields)->filter(fn($f) => !empty($profile->$f))->count();
            $hasSkills = $profile->skills->count() > 0 ? 1 : 0;
            $hasExp    = $profile->experiences->count() > 0 ? 1 : 0;
            $hasEdu    = $profile->educations->count() > 0 ? 1 : 0;
            $total     = count($fields) + 3;
            $done      = $filled + $hasSkills + $hasExp + $hasEdu;
            $percent   = round(($done / $total) * 100);
        @endphp

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-base font-semibold text-gray-800">Profile completion</h2>
                <span class="text-sm font-semibold text-teal-600">{{ $percent }}%</span>
            </div>

            <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                <div class="h-1.5 rounded-full bg-teal-500 transition-all duration-500"
                     style="width: {{ $percent }}%"></div>
            </div>

            @if($percent < 100)
                <p class="text-xs text-gray-400 mt-2">
                    Complete your profile to get more visibility with recruiters.
                </p>
            @else
                <p class="text-xs text-teal-600 mt-2 font-medium">
                    Your profile is 100% complete 🎉
                </p>
            @endif
        </div>

    </div>
</div>
@endsection
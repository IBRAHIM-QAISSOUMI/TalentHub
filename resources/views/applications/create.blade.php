@extends('layouts.app')

@section('title', 'Application create')

@section('content')
    <div class="py-8">
        <!-- main -->
            <div class="h-screen max-w-3xl mx-auto px-4 space-y-6">
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <div class="items-center gap-3">
                <div class="flex items-center gap-x-1">
                    <a href="{{ url()->previous() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <h1 class="text-xl text-gray-800 font-semibold">Apply for this position</h1>
                </div>
                <p class="text-sm text-gray-700 pl-6 pt-1">{{$job->title}} - {{$job->company->name}}</p>
            </div>
            
            <!-- form -->
            <form method="post" action="{{route('application.store', $job->id)}}">
                @csrf
                
                <div class="bg-white px-6 py-5 border border-gray-200 shadow-sm rounded-lg space-y-6">
                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">full name</label>
                        <input type="text"
                               value="{{auth()->user()->name}}"
                               readonly
                               placeholder="Your Full Name"
                               class="w-full border border-gray-100 bg-gray-50 px-3 py-2.5 rounded-xl shadow-sm text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">email</label>
                        <input type="text"
                               value="{{auth()->user()->email}}"
                               readonly
                               placeholder="Your Full Name"
                               class="w-full border border-gray-100 bg-gray-50 px-3 py-2.5 rounded-xl shadow-sm text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">cover letter</label>
                        <textarea type="text"
                               name="cover_letter"
                               rows="3"
                               placeholder="Why are you a good fit for this role?"
                               class="w-full border border-gray-100 bg-gray-50 px-3 py-2.5 rounded-xl shadow-sm text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                        >{{old('cover_latter')}}</textarea>
                        @error('cover_letter')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">cv / resume</label>
                        @php
                            $cv = auth()->user()->candidateProfile->cv;
                            $path = storage_path('app/public/' . $cv);
                        @endphp
                        @if($cv && file_exists($path))
                            <a  href="{{asset('storage/' . $cv)}}"
                                target="_blank"
                                class="w-full flex items-center gap-2 border border-dashed border-gray-400 rounded-xl p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-700">
                                        Click to upload youre CV
                                    </span>
                                    <span class="text-start text-xs text-gray-500">
                                        PDF up to {{ round(filesize($path) / 1024 , 2) }} KB
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-4">
                                <p class="text-sm text-yellow-700">
                                    You haven't uploaded your CV yet. Please upload your CV before applying for this job.
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- submit -->
                    <button type="submit"
                       class="flex ml-auto items-center w-fit gap-1.5 text-sm px-3 py-2 rounded-lg tracking-wide bg-gray-900 text-white hover:bg-gray-800 transition">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                       </svg>
                       Apply now
                    </button>
                
                </div>
            </form>
            <!-- end form -->
         </div>
        <!-- end main -->
    </div>
@endsection
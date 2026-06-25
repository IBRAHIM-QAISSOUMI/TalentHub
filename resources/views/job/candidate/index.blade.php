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

            <!-- filter jobs -->
            <div class="flex justify-between gap-3">
               <input type="text"
                      class="w-full rounded-lg border border-gray-300 text-gray-600 placeholder:text-gray-600 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent"
                      placeholder="Search by title..."
               >

               <select name="status" id="status"
                       class="rounded-lg border border-gray-300 text-gray-600 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent">
                   <option value="">Contract</option>
                   <option value="full-time">Full-time</option>
                   <option value="part-time">Part-time</option>
                   <option value="internship">Internship</option>
               </select>

               <select name="status" id="status"
                       class="rounded-lg border border-gray-300 text-gray-600 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent">
                   <option value="">Work mode</option>
                   <option value="remote">Remote</option>
                   <option value="on-site">On-site</option>
                   <option value="hybrid">Hybrid</option>
               </select>
            </div>
            <!-- end filter jobs -->

            <!-- jobs list -->
             <div class="space-y-3">
                @if($jobs->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        No job offers available.
                    </div>
                @else
                    @foreach($jobs as $job)
                        <div class="bg-gray-50 flex items-center gap-x-3 border rounded-lg border-gray-300 shadow-sm px-6 py-4">
                            <!-- image -->
                            <div class="flex items-center h-12 w-12 bg-violet-50 border border-gray-200 rounded-lg ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 mx-auto">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <!-- end image -->

                            <!-- details -->
                             <div>
                                <h2 class="text-base font-medium text-gray-800 capitalize">{{$job->title}}</h2>
                                <span class="flex items-center gap-0.5 text-xs text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    {{$job->company->name}}
                                </span>
                                <div class="flex items-center gap-1 pt-1.5">
                                    <span class="text-xs py-0.5 px-1.5 text-blue-700 rounded-lg font-medium bg-blue-100 capitalize">{{$job->contract_type}}</span>
                                    <span class="text-xs py-0.5 px-1.5 text-yellow-700 rounded-lg font-medium bg-yellow-100 capitalize">{{$job->work_mode}}</span>
                                    <span class="flex items-center text-xs text-gray-500 capitalize gap-x-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg> 
                                        {{$job->location}} -
                                    </span>

                                    <span class="text-xs text-gray-500">{{$job->created_at->diffForHumans()}}</span>
                                </div>
                             </div>
                            <!-- end details -->

                            <!-- action button  -->
                            <a href="{{route('jobs.show', $job->id)}}"
                                class="ml-auto text-sm px-3 py-1.5 font-mediun text-gray-800 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition">
                                View
                            </a>
                        </div>
                    @endforeach
                @endif
             </div>
            <!-- end jobs list -->
         </div>
        <!-- end main -->
    </div>

@endsection
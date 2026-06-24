@extends('layouts.app')

@section('title', 'Company Jobs')

@section('content')
    <div class="py-8">

         <!-- main content -->
        <div class="max-w-3xl mx-auto px-4 space-y-6">

            <!-- header -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-xl text-gray-800 font-semibold">Job offers</h1>
                        <p class="text-sm text-gray-600">{{$jobs[0]->company->name}} Corp</p>
                    </div>
                    <a href="{{route('jobs.create')}}"
                        class="flex items-center gap-1.5 text-sm px-3 py-2 rounded-lg tracking-wide bg-gray-900 text-white hover:bg-gray-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create job
                    </a>
                </div>

                <!-- total offers -->
                <div class="grid grid-cols-3 gap-4">
                     
                    <div class="bg-violet-50 border px-4 py-3 rounded-lg shadow-sm">
                        <span class="text-xs text-gray-600">Total offers</span>
                        <span class="block text-gray-900 text-xl font-semibold">{{$jobs->count()}}</span>
                    </div>

                    <div class="bg-violet-50 border px-4 py-3 rounded-md shadow-sm">
                        <span class="text-xs text-gray-600">Open</span>
                        <span class="block text-gray-900 text-xl font-semibold">{{$jobs->where('is_closed', 0)->count()}}</span>
                    </div>

                    <div class="bg-violet-50 border px-4 py-3 rounded-md shadow-sm">
                        <span class="text-xs text-gray-600">Closed</span>
                        <span class="block text-gray-900 text-xl font-semibold">{{$jobs->where('is_closed', 1)->count()}}</span>
                    </div>
                </div>

                <!-- filter -->
                 <div class="flex justify-between gap-3">
                    <input type="text"
                           class="w-full rounded-lg border border-gray-300 text-gray-600 placeholder:text-gray-600"
                           placeholder="Search by title..."
                    >

                    <select name="status" id="status"
                            class="rounded-lg border border-gray-300 text-gray-600">
                        <option value="">All statuses</option>
                        <option value="0">open</option>
                        <option value="1">closed</option>
                    </select>
                 </div>
                <!-- end filter -->

                <!-- jobs -->
                 <div class="space-y-3">
                    @if($jobs->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            No job offers available.
                        </div>
                    @else 
                    @foreach($jobs as $job)
                        <div class="{{$job->is_closed ? 'bg-gray-50 text-gray-500' : 'bg-white'}} flex items-center gap-3 border rounded-lg border-gray-300 shadow-sm px-6 py-4">
                            <!-- image -->
                            <div class="flex items-center h-10 w-10 bg-violet-50 border border-gray-200 rounded-lg ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 mx-auto">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <!-- end image -->

                            <!-- job info -->
                            <div>
                                <h3 class="text-sm font-medium tracking-wide capitalize">{{$job->title}}</h3>
                                <div class="{{$job->is_closed ? 'text-gray-400' : 'text-gray-500'}} flex gap-1.5 text-xs">

                                    <span class="flex items-center gap-0.5 capitalize">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        {{$job->location}} 
                                    </span>

                                    <span>-</span>

                                    <span class="capitalize">
                                        {{$job->contract_type}}
                                    </span>

                                    <span>-</span>

                                    <span class="capitalize">
                                        {{$job->work_mode}}
                                    </span>

                                    <span>-</span>

                                    <span class="flex items-center gap-0.5 capitalize">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>

                                        {{$job->applications->count()}} applications
                                    </span>

                                </div>
                            </div>
                            <!-- end job info -->

                            <!-- action buttons -->
                            <div class="flex items-center gap-x-2 ml-auto">
                               <span class="text-xs py-1 px-3 text-gray-800 rounded-lg {{$job->is_closed ? 'bg-gray-50 text-gray-200 border border-gray-300' : 'bg-lime-100'}} ">{{$job->is_closed ? 'Closed' : 'Open'}}</span>

                               <a href="{{route('jobs.show', $job->id)}}"
                                  class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                               </a>

                               <a href="{{route('jobs.edit', $job->id)}}"
                                  class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                               </a>

                               <a href="{{route('jobs.destroy', $job->id)}}"
                                  class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 {{$job->is_closed ? 'text-red-400' : 'text-red-500'}}">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                               </a>
                            </div>
                            <!-- end action buttons -->
                        </div>
                    @endforeach

                    @endif
                 </div>
                <!-- end jobs -->
            <!-- end header -->
        </div>
        <!-- end main content -->
    </div>
@endsection
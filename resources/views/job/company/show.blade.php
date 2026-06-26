@extends('layouts.app')

@section('title', 'Job Show')

@section('content')

    <div class="py-8">
        <!-- main -->
         <div class="max-w-3xl mx-auto px-4 space-y-4">
                <!-- cover image -->
                <div class="w-full h-56 rounded-2xl overflow-hidden">
                    <img src="{{ asset('storage/' . $job->image) }}" 
                         alt="cover image"
                         class="w-full h-full object-cover object-center">
                </div>
                <!-- end cover image -->

                <!-- status and buttons -->
                 <div class="flex justify-between">
                    <div>
                        <span class="{{$job->is_closed ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}} text-xs py-1 px-3 rounded-lg font-medium capitalize">{{$job->is_closed ? 'Closed' : 'Open'}}</span>
                        <span class="text-xs py-1 px-3 text-blue-700 rounded-lg font-medium bg-blue-100 capitalize">{{$job->contract_type}}</span>
                        <span class="text-xs py-1 px-3 text-yellow-700 rounded-lg font-medium bg-yellow-100 capitalize">{{$job->work_mode}}</span>
                    </div>

                    @if(auth()->user()->id === $job->company->user_id)
                    <div class="flex gap-3">
                           <a href="{{route('jobs.edit', $job->id)}}"
                              class="border border-gray-300 p-2 rounded-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                           </a>
                           <form method="post" action="{{route('jobs.destroy', $job->id)}}"
                              class="border border-red-300 rounded-lg hover:bg-gray-100">
                              @csrf
                              @method('delete')
                                <button type="submit" class="p-2" onclick="return confirm('Are you sure?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-red-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                           </form>
                    </div>
                    @endif
                </div>
                <!-- end status and buttons -->

                <!-- details -->
                 <div>
                     <h1 class="text-2xl font-semibold text-gray-900 tracking-wide capitalize">{{$job->title}}</h1>

                     <div class="flex gap-x-3">
                        <span class="flex items-center gap-1 capitalize text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>

                            {{$job->company->name}} 
                        </span>

                         <span class="flex items-center gap-1 capitalize text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{$job->location}} 
                        </span>
                     </div>

                     <div class="mt-4 flex items-center gap-x-1 text-gray-500 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Posted on {{$job->created_at->format('M d,Y')}}
                     </div>

                 </div>
                <!-- end details -->

                <!-- status -->
                    <div class="flex gap-4">
                        <div class="w-full bg-slate-100 border px-4 py-3 rounded-lg shadow-sm">
                            <span class="text-xs text-gray-600">Contract</span>
                            <span class="block text-gray-900 text-xl font-semibold">{{$job->contract_type}}</span>
                        </div>

                        <div class="w-full bg-slate-100 border px-4 py-3 rounded-lg shadow-sm">
                            <span class="text-xs text-gray-600">Work mode</span>
                            <span class="block text-gray-900 text-xl font-semibold">{{$job->work_mode}}</span>
                        </div>

                        <div class="w-full bg-slate-100 border px-4 py-3 rounded-lg shadow-sm">
                            <span class="text-xs text-gray-600">Applications</span>
                            <span class="block text-gray-900 text-xl font-semibold">{{$job->applications->count()}}</span>
                        </div>
                    </div>
                <!-- end status -->

                <!-- description -->
                 <div class="bg-white border border-gray-200 rounded-lg px-6 py-5">
                    <h2 class="text-base text-gray-700 pb-4">Description</h2>
                    <p class="text-sm text-gray-800 font-medium leading-relaxed">{{$job->description}}</p>
                 </div>
                <!-- end description -->

                @if(auth()->user()->id === $job->company->user_id)
                <!-- Offer status -->
                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg px-6 py-5">
                    <div>
                        <p class="text-sm font-medium text-gray-800">Offer status</p>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $job->is_closed ? 'No longer accepting applications' : 'Currently accepting applications' }}
                        </p>
                    </div>

                    <form action="{{ route('jobs.toggle', $job->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors
                                {{ $job->is_closed ? 'bg-gray-300' : 'bg-green-500' }}">
                            <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform
                                {{ $job->is_closed ? 'translate-x-1' : 'translate-x-6' }}">
                            </span>
                        </button>
                    </form>
                </div>
                <!-- End Offer status -->
                @endif

                <!-- buttons -->
                <div class="flex justify-end gap-3">
                    <a href="{{route('jobs.index')}}"
                       class="text-sm px-3 py-2 rounded-lg tracking-wide border border-gray-400 bg-gray-50 text-gray-800 hover:bg-gray-100 transition">
                       Cancel
                    </a>

                    @if(auth()->user()->id === $job->company->user_id)
                    <a href="#"
                       class="flex items-center w-fit gap-1.5 text-sm px-3 py-2 rounded-lg tracking-wide bg-gray-900 text-white hover:bg-gray-800 transition">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                       </svg>
                       View applications
                    </a>
                    @else
                    <a href="{{route('application.create', $job->id)}}"
                       class="flex items-center w-fit gap-1.5 text-sm px-3 py-2 rounded-lg tracking-wide bg-gray-900 text-white hover:bg-gray-800 transition">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                       </svg>
                       Apply now
                    </a>
                    @endif
                </div>
         </div>
        <!-- end main -->
    </div>

@endsection
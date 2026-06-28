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
                <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Total</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$applications->count()}}</span>
                </div>
                
                <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Pending</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$applications->where('status', 'pending')->count()}}</span>
                </div>

                <div class="w-full bg-orange-50 border px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Accepted</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$applications->where('status', 'accepted')->count()}}</span>
                </div>
            </div>
            <!-- end status -->

            <!-- filter -->
            <select name="status" id="status"
                    class="rounded-lg border border-gray-300 text-gray-600 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent">
                <option value="">All statuses</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">rejected</option>
            </select>
            <!-- end filter -->

            <!-- list applications -->
             @foreach($applications as $application)
                <div class="bg-white px-6 py-5 border  rounded-lg border-l-4
                    {{ $application->status == 'pending' ? 'border-l-yellow-500' : '' }}
                    {{ $application->status == 'accepted' ? 'border-l-green-500' : '' }}
                    {{ $application->status == 'rejected' ? 'border-l-red-500' : '' }}">
                    
                    <!-- top card -->
                    <div class="flex items-center gap-3">
                        <!-- image -->
                        <div class="flex items-center h-12 w-12 bg-orange-50 border border-gray-200 rounded-lg ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 mx-auto">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <!-- end image -->

                        <!-- detatils -->
                         <div>
                            <h3 class="text-sm text-gray-800 font-medium capitalize">{{$application->jobOffer->title}}</h3>
                            <span class="flex items-center gap-x-0.5 text-gray-700 text-xs mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                                {{$application->jobOffer->company->name}}
                            </span>
                            <span class="flex items-center gap-x-0.5 text-gray-500 text-xs mt-1 capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                {{$application->jobOffer->location}} - 
                                {{$application->jobOffer->contract_type}} - 
                                {{$application->jobOffer->work_mode}} 
                            </span>
                         </div>
                         <!-- end details -->

                         <!-- status -->
                          <span class="text-xs font-medium capitalize rounded-lg px-2 py-0.5 ml-auto mb-auto
                                {{ $application->status == 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                                {{ $application->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $application->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}"

                                >{{$application->status}}</span>
                        <!-- status -->
                    
                    </div>
                    <!-- end top card -->

                    <div class="my-4 w-full border-t border-gray-300"></div>

                    <!-- bottom card -->
                     <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Applied {{$application->created_at->format('M d,Y')}}
                        </div>

                        <div class="flex  items-center gap-2">
                            <a href="{{route('jobs.show', $application->jobOffer->id)}}"
                                class="flex items-center gap-1 text-sm px-3 py-1.5 font-mediun text-gray-800 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                View
                            </a>

                            @if($application->status === 'pending')
                            <form method="post" action="{{route('applications.delete', $application->id)}}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="flex items-center gap-1 text-sm px-3 py-1.5 font-mediun text-red-700 bg-white border border-gray-400 rounded-lg hover:bg-gray-50 transition"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                    Cancel</button>
                            </form>
                            @endif
                        </div>
                     </div>
                    <!-- end bottom card -->
                     


                </div>
             @endforeach
            <!-- list end applications -->

            <!------------------------------- END UI CANDIDATE ------------------------------->

            <!------------------------------- UI COMPANY ------------------------------->
            @else
            <div>
                <h1 class="text-xl text-gray-800 font-semibold">Applications received</h1>
                <p class="text-sm text-gray-700 ">{{$jobs[0]->company->name}}</p>
            </div>

            <!-- status -->
            <div class="flex gap-x-4">
                <div class="w-full bg-white border border-gray-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Total</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$totalApplications}}</span>
                </div>
                
                <div class="w-full bg-amber-50 border border-amber-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Pending</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$pending}}</span>
                </div>

                <div class="w-full  bg-green-50 border border-green-200 px-4 py-3 rounded-lg shadow-sm">
                    <span class="text-xs text-gray-600">Accepted</span>
                    <span class="block text-gray-900 text-xl font-semibold">{{$accepted}}</span>
                </div>
            </div>
            <!-- end status -->

            @foreach($jobs as $job)

            <!-- Card -->
             <div class="border border-gray-200 rounded-lg shadow-sm overflow-hidden">

                <!-- top card -->
                <div class="flex items-center justify-between px-6 py-5 bg-gradient-to-r from-gray-100 to-white border-b border-gray-200">

                    <div class="flex items-center gap-3">

                        <!-- image -->
                        <div class="flex items-center h-10 w-10 bg-white border border-gray-200 rounded-lg ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 mx-auto">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>

                        <!-- detatils -->
                         <div>
                            <h3 class="text-sm text-gray-800 font-medium capitalize">{{$job->title}}</h3>
                            <span class="flex items-center gap-x-0.5 text-gray-500 text-xs mt-1 capitalize">
                                {{$job->location}} - 
                                {{$job->contract_type}} -
                                {{$job->work_mode}}
                            </span>
                         </div>

                    </div>

                    <div class="flex items-center gap-4">
                        <!-- status -->
                        <span class="text-xs font-medium capitalize rounded-lg px-2 py-0.5 ml-auto mb-auto
                            {{ $job->is_closed ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}}"
                            >{{$job->is_closed ? 'Closed' : 'Open'}}</span>

                         <span class="text-xs text-gray-600">{{$job->applications->count()}} applications</span>
                    </div>

                
                </div>
                <!-- end top card -->

                <!-- middle card -->
                 @foreach($job->applications as $application)
                 <div class="flex justify-between items-center bg-white px-6 py-4 border-b border-gray-200 overflow-hidden">

                    <div class="flex items-center gap-3 pl-3 border-l-4
                        {{$application->status === 'pending' ? 'border-l-amber-500' : ''}}
                        {{$application->status === 'accepted' ? 'border-l-green-500' : ''}}
                        {{$application->status === 'rejected' ? 'border-l-red-500' : ''}}
                        ">
                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shadow">
                            <span class="text-blue-700 text-md">
                                 {{ strtoupper(substr($application->user->name, 0, 2)) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm text-gray-800 font-medium capitalize">{{$application->user->name}}</h3>
                            <p class="text-xs text-gray-600">Applied {{$application->created_at->format('M d')}}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs font-medium capitalize rounded-lg px-2 py-0.5
                            {{ $application->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $application->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $application->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}"
                            >{{$application->status}}
                        </span>
                        <a href="#"
                           class="block border border-gray-300 p-1.5 rounded-lg text-gray-700 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>

                 </div>
                 @endforeach
                <!-- end middle card -->

                <!-- buttom card -->
                 <div class="bg-gary-50 px-6 py-4">
                    <a href="{{route('job-applications', $job->id)}}"
                       class="flex items-center gap-1 text-sm text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        View all {{$job->Applications->count()}} applications 
                    </a>
                 </div>         
                <!-- end buttom card -->

             </div>
             <!-- End Card -->
             @endforeach

            @endif
            <!------------------------------- END UI COMPANY ------------------------------->
        </div>
        <!-- end main -->
    </div>
@endsection
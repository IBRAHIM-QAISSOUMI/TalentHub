@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    
<div class="min-h-screen py-4 md:py-8 px-2 md:px-0">
     
     <!-- main content -->
     <div class="max-w-5xl mx-auto md:flex md:flex-row md:gap-6 lg:gap-8">

        <!-- left side -->
         <div class="w-full md:w-2/3 space-y-4">

           @if(session('success'))
             <div class="rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-700 text-sm">
                 {{ session('success') }}
             </div>
           @endif

           @if(session('error'))
             <div class="rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-red-700 text-sm">
                 {{ session('error') }}
             </div>
           @endif

            <!------------ HEADER CARD ------------>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                
                <!-- GRADIENT HEADER -->
                <div class="h-20 sm:h-24 md:h-28 lg:h-32 bg-gradient-to-r from-blue-600 to-teal-500"></div>

                <div class="relative px-4 sm:px-6 pb-4 sm:pb-6 h-12 sm:h-16">

                    <!-- AVATAR -->
                     <div class="absolute -top-10 sm:-top-12 md:-top-14">
                       @if($profile->avatar)
                        <img src="{{asset('storage/' . $profile->avatar)}}" 
                             alt="avatar profile"
                             class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white object-cover shadow-sm">
                       @else
                          <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white bg-blue-100 flex items-center justify-center shadow">
                              <span class="text-blue-700 text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold">
                                   {{ strtoupper(substr($profile->user->name, 0, 2)) }}
                              </span>
                          </div>
                       @endif
                    </div>

                     <!-- BUTTONS ACTION -->
                      <div class="flex justify-end pt-1 sm:pt-2 gap-1.5 sm:gap-2">
                        @if($profile->cv)
                           <a href="{{asset('storage/' . $profile->cv)}}"
                              target="_blank"
                              class="inline-flex items-center gap-1 px-3 sm:px-4 py-1.5 sm:py-2 border border-gray-200 rounded-lg sm:rounded-xl text-xs text-gray-600 hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-8m0 8l-3-3m3 3l3-3M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2"/>
                                </svg>
                                <span class="hidden xs:inline">Download CV</span>
                                <span class="xs:hidden">CV</span>
                           </a>
                        @endif

                        @if(auth()->user()->id !== $profile->user_id)
                          
                          <!-- friends system -->
                          @if($status == 'add')
                          <form method="post" action="{{route('friend.send', $profile->user)}}">
                            @csrf
                            <button type="submit"
                               class="inline-flex items-center text-xs rounded-lg px-3 sm:px-4 py-1.5 sm:py-2 gap-1 text-white bg-blue-600 hover:bg-blue-700 transition">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                               </svg>
                               <span class="hidden xs:inline">Add Friend</span>
                               <span class="xs:hidden">Add</span>
                            </button>
                          </form>

                          @elseif($status == 'sent')
                          <form method="post" action="{{route('friend.reject', $profile->user)}}">
                            @csrf
                            @method('delete')
                            <button type="submit"
                               class="flex items-center gap-1 text-xs font-medium text-gray-500 border border-gray-200 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg hover:bg-gray-50 transition">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                               </svg>
                               <span class="hidden xs:inline">Cancel</span>
                               <span class="xs:hidden">X</span>
                            </button>
                          </form>

                          @elseif($status == 'received')
                          <div class="flex flex-col gap-1">
                             <form method="post" action="{{route('friend.accept', $profile->user)}}">
                               @csrf
                               @method('patch')
                               <button type="submit"
                                  class="flex items-center gap-1 text-xs font-medium bg-gray-900 text-white px-3 sm:px-4 py-1 rounded-lg hover:bg-gray-700 transition">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                  </svg>
                                  <span class="hidden xs:inline">Accept</span>
                                  <span class="xs:hidden">✓</span>
                               </button>
                             </form>

                             <form method="post" action="{{route('friend.reject', $profile->user)}}">
                               @csrf
                               @method('delete')
                               <button type="submit"
                                  class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 border border-gray-200 px-3 sm:px-4 py-1 rounded-lg hover:bg-gray-50 transition">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                  </svg>
                                  <span class="hidden xs:inline">Decline</span>
                                  <span class="xs:hidden">✕</span>
                               </button>
                             </form>
                          </div>

                          @elseif($status == 'friends')
                             <form method="post" action="{{route('friend.reject', $profile->user)}}">
                               @csrf
                               @method('delete')
                               <button type="submit"
                                  onclick="return confirm('Do you want to unfriend?')"
                                  class="inline-flex items-center gap-1 px-3 sm:px-4 py-1.5 sm:py-2 border border-gray-200 rounded-lg text-xs text-gray-600 hover:bg-gray-50 transition">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                  </svg>
                                  <span class="hidden xs:inline">Friends</span>
                                  <span class="xs:hidden">Friends</span>
                               </button>
                             </form>
                          @endif
                          
                       @else
                        <a href="{{route('candidate.edit')}}"
                           class="inline-flex items-center text-xs rounded-lg px-3 sm:px-4 py-1.5 sm:py-2 gap-1 text-white bg-blue-600 hover:bg-blue-700 transition"
                           >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                            </svg>
                            <span class="hidden xs:inline">Edit profile</span>
                            <span class="xs:hidden">Edit</span>
                         </a>
                         @endif
                      </div>
                </div>

                <!-- identity -->
                <div class="px-4 sm:px-6 mt-1 sm:mt-2">
                    <h1 class="font-semibold text-lg sm:text-xl lg:text-2xl text-gray-900 capitalize">{{$profile->user->name}}</h1>
                    <p class="text-sm text-gray-500 mt-0.5">{{$profile->title}}</p>
                    <div class="flex items-center gap-1 mt-1 text-gray-400">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                       </svg>
                       <p class="text-xs capitalize">{{$profile->city}}, {{$profile->country}}</p>
                    </div>
                    
                 </div>
                 <!-- bio -->
                 <div class="text-sm text-gray-600 mt-4 sm:mt-5 leading-relaxed px-4 sm:px-6 pb-4 sm:pb-6">{{$profile->bio}}</div>
     
            </div>
            <!------------ END HEADER CARD ------------>


            <!------------ SKILLS ------------>
              @if($profile->skills->count())
                 <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden px-4 sm:px-6 py-4 sm:py-5">
                       <div class="flex items-center justify-between mb-3 sm:mb-4">
                             <h1 class="text-sm sm:text-base font-semibold capitalize text-gray-800">skills</h1>
                             
                             @if(auth()->user()->id == $profile->user_id)
                             <a href="{{route('candidate.edit')}}" class="hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                                </svg>
                             </a>
                             @endif
                       </div>

                       <div class="flex flex-wrap gap-1.5 sm:gap-2"> 
                          @foreach($profile->skills as $skill)
                            <span class="text-xs font-medium bg-blue-50 border border-blue-100 text-blue-700 px-2.5 sm:px-3 py-1 rounded-full">
                                {{$skill->name}}
                             </span>
                          @endforeach     
                       </div> 

                 </div>
              @endif
            <!------------ END SKILLS ------------>

            <!------------ EXPERIENCE ------------>
            @if($profile->experiences->count())
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-4 sm:px-6 py-4 sm:py-5">
                  <div class="flex items-center justify-between mb-3 sm:mb-4">
                     <h1 class="text-sm sm:text-base font-semibold capitalize text-gray-800">experiences</h1>
                     
                     @if(auth()->user()->id == $profile->user_id)
                     <a href="{{route('candidate.edit')}}" class="hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                        </svg>
                     </a>
                     @endif
                  </div>
                 
                  @foreach($profile->experiences as $exp)

                  <div class="flex gap-3 sm:gap-3.5 pb-4 sm:pb-5 {{!$loop->last ? 'border-b border-gray-50' : ''}}">

                       <!-- icon -->
                       <div class="w-8 h-8 sm:w-9 sm:h-9 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15"/>
                          </svg>
                       </div>

                       <!-- details -->
                       <div class="space-y-0.5">
                          <h3 class="text-sm font-medium capitalize">{{$exp->position}}</h3>
                          <p class="text-xs text-gray-500 capitalize">{{$exp->company}}</p>
                          <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }}
                             -
                             {{ $exp->end_date
                                 ? \Carbon\Carbon::parse($exp->end_date)->format('M Y')
                                 : 'Present'
                             }}
                          </p>
                       </div>
                  </div>
                  @endforeach

            </div>
            @endif
            <!------------ END EXPERIENCE ------------>
            

            <!------------ EDUCATION ------------>
            @if($profile->educations->count())
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-4 sm:px-6 py-4 sm:py-5">
                  <div class="flex items-center justify-between mb-3 sm:mb-4">
                     <h1 class="text-sm sm:text-base font-semibold capitalize text-gray-800">educations</h1>
                     
                     @if(auth()->user()->id == $profile->user_id)
                     <a href="{{route('candidate.edit')}}" class="hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z"/>
                        </svg>
                     </a>
                     @endif
                  </div>
                 
                  @foreach($profile->educations as $edu)

                  <div class="flex gap-3 sm:gap-3.5 pb-4 sm:pb-5 {{!$loop->last ? 'border-b border-gray-50' : ''}}">

                       <!-- icon -->
                       <div class="w-8 h-8 sm:w-9 sm:h-9 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z"/>
                          </svg>
                       </div>

                       <!-- details -->
                       <div class="space-y-0.5">
                          <h3 class="text-sm font-medium capitalize">{{$edu->degree}}</h3>
                          <p class="text-xs text-gray-500 capitalize">{{$edu->school}}</p>
                          <p class="text-xs text-gray-400"> 
                             {{$edu->start_year}}
                             -
                             {{ $edu->end_year ? $edu->end_year : 'Present'}}
                          </p>
                       </div>
                  </div>
                  @endforeach

            </div>
            @endif
            <!------------ END EDUCATION ------------>
     
         </div>
        <!-- end left side -->

        <!-- right side -->
         <div class="w-full mt-4 md:w-1/3 md:mt-0 space-y-4">
           
           <!-- Suggested Friends -->
           @include('components.suggested-friends', ['users' => $users])
           
           <!-- PROFILE COMPLETION  -->
           @if(auth()->user()->id == $profile->user_id)
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
              <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-4 sm:px-6 py-4 sm:py-5">
                 <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm sm:text-base font-semibold text-gray-800">Profile completion</h2>
                    <span class="text-sm font-semibold text-teal-600">{{ $percent }}%</span>
                   </div>
                   <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                      <div class="h-1.5 rounded-full bg-teal-500 transition-all duration-500"
                      style="width: {{ $percent }}%">
                   </div>
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
           @endif
           
           <!-- EMAIL SECTION -->
            @if(auth()->user()->id == $profile->user_id)
           <div class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl shadow-sm px-4 py-3">
               <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                   <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                   </svg>
               </div>
               <div class="min-w-0 flex-1">
                   <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->email }}</p>
                   <p class="text-xs text-gray-400">{{ auth()->user()->created_at->diffForHumans() }}</p>
               </div>
           </div> 
           @endif

        </div>
        <!-- end right side -->

     </div>
     <!-- end main content -->
 </div>

@endsection
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-6 py-5 space-y-2">
                     <div class="flex items-center justify-between">
                        <h2 class="text-base font-semibold capitalize text-gray-800">Suggested Friends</h2>
                        <span class="w-7 h-7 flex items-center justify-center text-sm text-gray-800 bg-gray-100 border border-gray-200 rounded-full">{{$users->count()}}</span>
                     </div>

                     <div class="flex">
                        @for($i = 0; $i < min(4, $users->count()); $i++) 

                           @if($i == 3)
                           <div class="w-10 h-10 text-sm rounded-full  border-2 border-white bg-gray-100 flex items-center justify-center shadow -ml-2">
                              +{{$users->count()- $i}}
                           </div>
                           @else  

                              @if($users[$i]->candidateProfile->avatar)
                               <img src="{{asset('storage/' . $users[$i]->candidateProfile->avatar)}}" 
                                    alt="avatar profile"
                                    class="w-10 h-10 rounded-full border-2 border-white object-cover shadow-sm -ml-2">
                              @else
                                 <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-100 flex items-center justify-center shadow -ml-2">
                                     <span class="text-blue-700 text-sm">
                                             {{ strtoupper(substr($users[$i]->name, 0, 2)) }}
                                     </span>
                                 </div>
                              @endif
                              
                           @endif

                        @endfor
                     </div>

                     <!-- List Suggested Friends -->
                     <div class="space-y-2">
                        @for($i = 0; $i < min(3, $users->count()); $i++) 
                        <div class="flex items-center gap-2">
                              @if($users[$i]->candidateProfile->avatar)
                               <img src="{{asset('storage/' . $users[$i]->candidateProfile->avatar)}}" 
                                    alt="avatar profile"
                                    class="min-w-11 w-11 h-11 shrink- rounded-full border-2 border-white object-cover shadow-sm">
                              @else
                                 <div class="min-w-11 w-11 h-11 shrink- rounded-full border-2 border-white bg-blue-100 flex items-center justify-center shadow ">
                                     <span class="text-blue-700 text-base">
                                             {{ strtoupper(substr($users[$i]->name, 0, 2)) }}
                                     </span>
                                 </div>
                              @endif

                              <div>
                                 <h3 class="text-sm text-gray-800">{{$users[$i]->name}}</h3>
                                 <p class="text-xs text-gray-500">{{$users[$i]->candidateProfile->title}}</p>
                              </div>

                              <a href="{{route('candidate.show', $users[$i]->id)}}"
                                 class="ml-auto text-sm capitalize text-gray-600 bg-white shadow-sm border border-gray-100 px-3 py-1 rounded-lg hover:bg-gray-50 transition">
                                 view
                              </a>
                        </div>

                        <div class="border border-gray-100"></div>
                                    
                        @endfor
                     </div>
                     <!-- End List Suggested Friends -->
                      <div class="flex justify-center bg-white py-2 shadow-sm border border-100-gray rounded-lg hover:bg-gray-50 transition">
                           <a href="#"
                              class="text-sm text-gray-800 "
                              >
                              See all {{$users->count()}} suggested friends
                           </a>
                      </div>

</div>
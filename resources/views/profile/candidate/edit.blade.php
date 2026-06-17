@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-8">

        <!-- card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
         <!-- GRADIENT HEADER -->
            <div class="h-24 bg-gradient-to-r from-blue-100 via-purple-100 to-amber-100"></div>
            
               <!-- avatar + name -->
               <div class="px-6 pb-4 flex items-end justify-between -mt-10">
           
               <!-- avatar -->
                  <div class="flex items-end gap-3">
                      <div class="h-20 w-20 rounded-full border-4 border-white shadow-s overflow-hidden">
                          <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=dbeafe&color=2563eb' }}" 
                               alt=""
                               class="w-full h-full object-cover"
                          >
                      </div>
                      
                      <div class="pb-0.5">
                          <p class="font-semibold text-gray-900 text-base leading-tight">{{Auth()->user()->name}}</p>
                          <p class="text-sm text-gray-500">{{Auth()->user()->email}}</p>
                      </div>
                  </div>
                  
                  <!-- edit badge -->
                  <span class="mb-1 text-xs font-medium bg-blue-600 text-white px-4 py-1.5 rounded-lg">
                      Edit Profile
                  </span>

            </div>

            <!-- Form -->
             <form method="post" 
                   action="{{route('candidate.update')}}" 
                   enctype="multipart/form-data" 
                   class="px-6 pb-8 space-y-6">

                @csrf
                @method('PUT')


                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                    <!-- profile picture -->
                    <div>
                       <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                            profile picture
                        </label>
                       <input type="file"
                              name="avatar"
                              accept="image/*"
                              class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    </div>

                    <!-- full name && title -->
                    <div class="border-t border-gray-100"></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">full name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="Your Full Name"
                                   class="w-full border border-gray-100 bg-gray-50 px-3 py-2.5 rounded-xl shadow-sm text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                        </div>

                        <div>
                            <label class="block text-xs mb-1.5 uppercase font-medium text-gray-500 tracking-wide"> 
                                Professional Title
                            </label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $candidateProfile->title ?? '') }}"
                                   placeholder="e.g. Full Stack Developer"
                                   class="w-full border border-gray-100 bg-gray-50 px-3 py-2.5 rounded-xl shadow-sm text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                        </div>
                    </div>

                    <!-- Country && city  -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                                Country
                            </label>
                            <input type="text"
                                   name="country"
                                   value="{{ old('country', $candidateProfile->country ?? '') }}"
                                   placeholder="Country"
                                   class="w-full border border-gray-100 bg-gray-50 rounded-xl shadow-sm text-sm px-3 py-2.5 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                                   >
                        </div>

                        <div>
                            <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                                City
                            </label>
                            <input type="text"
                                   name="city"
                                   value="{{ old('city', $candidateProfile->city ?? '') }}"
                                   placeholder="City"
                                   class="w-full border border-gray-100 bg-gray-50 rounded-xl shadow-sm text-sm px-3 py-2.5 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                                   >
                        </div>
                    </div>

                    <!-- bio -->
                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                            bio
                        </label>
                        <textarea name="bio"
                                  rows="3"
                                  value="{{ old('bio', $candidateProfile->bio ?? '') }}"
                                  placeholder="Write a short bio about yourself..."
                                  class="w-full border border-gray-100 bg-gray-50 rounded-xl shadow-sm text-sm px-3 py-2.5 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition resize-none"
                        ></textarea>
                    </div>

                    <!-- skills -->
                    <div>
                        <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                            skills
                        </label>

                        <select id="skillsSelect"
                                class="w-full border border-gray-100 bg-gray-50 rounded-xl shadow-sm text-sm px-3 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">

                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}">
                                    {{ $skill->name }}
                                </option>
                            @endforeach

                        </select>

                        <!-- selected skills -->
                        <div id="selectedSkills" class="flex flex-wrap gap-2 mt-3"></div>

                        <p class="text-xs text-gray-400 mt-1">
                            Select your skills
                        </p>
                    </div>
                    
                    <!-- JS FOR SKILLS  -->
                    <script>
                        const select = document.getElementById('skillsSelect');
                        const container = document.getElementById('selectedSkills');

                        let selected = [];

                        select.addEventListener('change', function(){

                            let id = this.value;
                            let name = this.options[this.selectedIndex].text;

                            if(!selected.find(skill => skill.id == id)){

                                selected.push({
                                    id:id,
                                    name:name
                                });

                                render();
                            }

                        });


                        function render(){

                            container.innerHTML = '';

                            selected.forEach(skill => {

                                container.innerHTML += `
                                    <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs flex items-center gap-2">

                                        ${skill.name}

                                        <button type="button"
                                            onclick="removeSkill(${skill.id})">
                                            ×
                                        </button>

                                    </div>

                                    <input type="hidden" name="skills[]" value="${skill.id}">
                                `;

                            });

                        }


                        function removeSkill(id){

                            selected = selected.filter(skill => skill.id != id);

                            render();
                        }

                    </script>

                    <!-- EXPERIENCE -->
                    <div>
                    <h2 class="text-sm font-semibold text-gray-700 mb-3">Experience</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Company</label>
                            <input
                                type="text"
                                name="experience[company]"
                                value="{{ old('experience.company', $profile->experience['company'] ?? '') }}"
                                placeholder="Company name"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Job Title</label>
                            <input
                                type="text"
                                name="experience[position]"
                                value="{{ old('experience.position', $profile->experience['position'] ?? '') }}"
                                placeholder="Your job title"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Start Date</label>
                            <input
                                type="date"
                                name="experience[start_date]"
                                value="{{ old('experience.start_date', $profile->experience['start_date'] ?? '') }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">End Date</label>
                            <input
                                type="date"
                                name="experience[end_date]"
                                value="{{ old('experience.end_date', $profile->experience['end_date'] ?? '') }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100"></div>

                <!-- EDUCATION -->
                <div>
                    <h2 class="text-sm font-semibold text-gray-700 mb-3">Education</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">School / University</label>
                            <input
                                type="text"
                                name="education[school]"
                                value="{{ old('education.school', $profile->education['school'] ?? '') }}"
                                placeholder="School or university"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Degree</label>
                            <input
                                type="text"
                                name="education[degree]"
                                value="{{ old('education.degree', $profile->education['degree'] ?? '') }}"
                                placeholder="e.g. Bachelor's in CS"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Start Year</label>
                            <input
                                type="number"
                                name="education[start_year]"
                                value="{{ old('education.start_year', $profile->education['start_year'] ?? '') }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">End Year</label>
                            <input
                                type="number"
                                name="education[end_year]"
                                value="{{ old('education.end_year', $profile->education['end_year'] ?? '') }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition"
                            >
                        </div>
                    </div>
                </div>

                <!-- CV -->
                 <div>
                    <label class="block text-xs font-medium mb-1.5 uppercase text-gray-500 tracking-wide">
                                Cv
                    </label>
                    <input type="file"
                           name="cv"
                           accept=".pdf"
                           class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"
                           >
                 </div>

                <!-- SAVE BUTTON -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm font-medium px-8 py-2.5 rounded-xl transition-all duration-150"
                    >
                        Save changes
                    </button>
                </div>
             </form>
        </div>

    </div>




@endsection
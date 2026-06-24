@extends('layouts.app')

@section('title', 'Create Jobs')

@section('content')
     <div class="py-8">
        <!-- main -->
         <div class="h-fit max-w-3xl mx-auto px-4 space-y-6">
            
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-xl text-gray-800 font-semibold">Edit job offer</h1>
            </div>

            <form action="{{route('jobs.update', $job->id)}}" 
                  method="post"
                  enctype="multipart/form-data" 
                  class="space-y-4">

            @csrf
            @method('PUT')
            <!-- General Info -->
            <div class="bg-white border border-gray-200 rounded-lg px-6 py-5 space-y-3 ">
                <h2 class="text-base text-gray-700">GENERAL INFO</h2>
                    <div class="space-y-1">
                        <label class="text-sm text-gray-600">Job title</label>
                        <span class="text-red-700">*</span>
                        <input type="text"
                               name="title"
                               class="block w-full rounded-lg text-gray-700 border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent @error('title') border-red-400 @enderror"
                               placeholder="e.g. Frontend Developer"
                               value="{{old('title', $job->title ?? '')}}">
                        @error('title')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm text-gray-600">location</label>
                        <span class="text-red-700">*</span>
                        <input type="text"
                               name="location"
                               class="block w-full rounded-lg text-gray-700 border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent @error('location') border-red-400 @enderror"
                               placeholder="e.g. Casablanca"
                               value="{{old('location', $job->location ?? '')}}">
                        @error('location')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 ">
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Contract type</label>
                            <span class="text-red-700">*</span>
                            <select name="contract_type"
                                    class="block w-full rounded-lg text-gray-700 border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent  @error('contract_type')  border-red-400 @enderror">
                                    <option value="full-time"
                                        {{ old('contract_type', $job->contract_type) == 'full-time' ? 'selected' : '' }}>
                                        Full Time
                                    </option>

                                    <option value="part-time"
                                        {{ old('contract_type', $job->contract_type) == 'part-time' ? 'selected' : '' }}>
                                        Part Time
                                    </option>

                                    <option value="internship"
                                        {{ old('contract_type', $job->contract_type) == 'internship' ? 'selected' : '' }}>
                                        Internship
                                    </option>
                            </select>
                            @error('contract_type')
                            <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Work mode</label>
                            <span class="text-red-700">*</span>
                            <select name="work_mode"
                                    class="block w-full rounded-lg text-gray-700 border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent @error('work_mode')  border-red-400 @enderror">
                                    <option value="remote"
                                        {{ old('work_mode', $job->work_mode) == 'remote' ? 'selected' : '' }}>
                                        Remote
                                    </option>

                                    <option value="on-site"
                                        {{ old('work_mode', $job->work_mode) == 'on-site' ? 'selected' : '' }}>
                                        On Site
                                    </option>

                                    <option value="hybrid"
                                        {{ old('work_mode', $job->work_mode) == 'hybrid' ? 'selected' : '' }}>
                                        Hybrid
                                    </option>
                            </select>
                            @error('work_mode')
                            <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                <!-- End General Info -->
                <!-- Description -->
                    <div class="bg-white border border-gray-200 rounded-lg px-6 py-5 space-y-3 ">
                        <h2 class="text-base text-gray-700">Description</h2>
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Job description</label>
                            <span class="text-red-700">*</span>
                            <textarea
                                   name="description"
                                   rows="3"
                                   placeholder="Describe the role, responsibilities, and requirements..."
                                   value="{{old('description')}}"
                                   class="block w-full rounded-lg text-gray-700 border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent @error('description')  border-red-400 @enderror"
                                   >{{old('description', $job->description ?? '')}}</textarea>
                            @error('description')
                            <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                <!-- End Description -->

                <!-- Cover image -->
                 <div class="bg-white border border-gray-200 rounded-lg px-6 py-5 space-y-3 ">
                 
                 <h2 class="inline text-base text-gray-700">Cover image</h2>
                 <span class="text-red-700">*</span>
                 <div x-data='{
                        preview: "{{ $job->image ? asset("storage/" . $job->image) : "" }}",
                        dragging: false
                    }'>
                    <label
                        for="image"
                        class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed rounded-xl cursor-pointer transition-all"
                        :class="dragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 bg-gray-50 hover:bg-gray-100'"
                        @dragover.prevent="dragging = true"
                        @dragleave.prevent="dragging = false"
                        @drop.prevent="
                            dragging = false;
                            const file = $event.dataTransfer.files[0];
                            if (file && file.type.startsWith('image/')) {
                                preview = URL.createObjectURL(file);
                                const dt = new DataTransfer();
                                dt.items.add(file);
                                $refs.input.files = dt.files;
                            }
                        "
                    >
                        {{-- Preview --}}
                        <template x-if="preview">
                            <div class="absolute inset-0 rounded-xl overflow-hidden">
                                <img :src="preview" class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 hover:opacity-100 transition">
                                    <span class="text-white text-sm font-medium">Change image</span>
                                </div>
                            </div>
                        </template>

                        {{-- Placeholder --}}
                        <template x-if="!preview">
                            <div class="flex flex-col items-center gap-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16l4-4a3 3 0 014 0l4 4m-4-4l2-2a3 3 0 014 0l2 2M3 20h18M21 8a2 2 0 00-2-2H5a2 2 0 00-2 2v12" />
                                </svg>
                                <p class="text-sm">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400">PNG, JPG up to 2MB</p>
                            </div>
                        </template>

                        <input
                            x-ref="input"
                            id="image"
                            name="image"
                            type="file"
                            accept="image/*"
                            class="hidden"
                            @change="
                                const file = $event.target.files[0];
                                if (file) preview = URL.createObjectURL(file);
                            "
                        />
                    </label>
                    @error('image')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    {{-- Remove button --}}
                    <template x-if="preview">
                        <button
                            type="button"
                            class="mt-2 text-xs text-red-500 hover:underline"
                            @click="
                                preview = null;
                                $refs.input.value = '';
                            "
                        >
                            Remove image
                        </button>
                    </template>
                </div>
                </div>
                <!-- End Cover image -->
                <div class="flex items-center gap-3 justify-end">
                    <button type="reset"
                            class="text-sm px-3 py-2 rounded-lg tracking-wide border border-gray-300 bg-white text-gray-800 hover:bg-gray-50 transition">
                            Cancel
                    </button>
                    <button type="submit"
                            class="text-sm px-3 py-2 rounded-lg tracking-wide bg-gray-900 text-white hover:bg-gray-800 transition">
                            Update offer
                    </button>
                </div>
            </form>
         </div>
        <!-- end main -->
     </div>
@endsection
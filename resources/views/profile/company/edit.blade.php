@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4">

            <!-- Page header -->
            <div class="mb-6">
                <h1 class="text-xl font-semibold text-gray-900">Edit company profile</h1>
                <p class="text-sm text-gray-500 mt-1">This information will be visible to candidates and other recruiters.
                </p>
            </div>


            <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- LOGO -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">

                    <p class="text-sm font-semibold text-gray-800 mb-4">Logo</p>

                    <div class="flex items-center gap-4">

                        <!-- Preview -->
                        <div id="logo-preview-wrapper"
                            class="w-18 h-18 rounded-xl bg-gray-50 border border-dashed border-gray-300 flex items-center justify-center flex-shrink-0 overflow-hidden"
                            style="width:72px;height:72px;">
                            @if ($company->logo)
                                <img id="logo-preview" src="{{ asset('storage/' . $company->logo) }}" alt="Logo"
                                    class="w-full h-full object-cover">
                            @else
                                <svg id="logo-placeholder" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15" />
                                </svg>
                                <img id="logo-preview" src="" alt="Logo"
                                    class="w-full h-full object-cover hidden">
                            @endif
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="logo"
                                class="cursor-pointer inline-flex items-center gap-1.5 text-xs font-medium border border-gray-200 rounded-lg px-3.5 py-2 text-gray-600 hover:bg-gray-50 transition w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Upload logo
                            </label>
                            <input type="file" name="logo" id="logo" accept="image/png,image/jpeg,image/jpg"
                                class="hidden">
                            <p class="text-xs text-gray-400">PNG or JPG or JPEG, max 2MB. Square recommended.</p>
                            @error('logo')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- BASIC INFORMATION  -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">

                    <p class="text-sm font-semibold text-gray-800 mb-4">Basic information</p>

                    <div class="space-y-4">

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-xs text-gray-500 mb-1.5">Company name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                                placeholder="e.g. TechCorp Maroc"
                                class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 @enderror">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry / Size  -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div>
                                <label for="industry" class="block text-xs text-gray-500 mb-1.5">Industry</label>
                                <select name="industry" id="industry"
                                    class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('industry') border-red-300 @enderror">
                                    <option value="">Select industry</option>
                                    @foreach (['Information Technology', 'Finance', 'Healthcare', 'Education', 'Retail', 'Manufacturing', 'Construction', 'Marketing & Advertising', 'Hospitality', 'Other'] as $industry)
                                        <option value="{{ $industry }}" @selected(old('industry', $company->industry) == $industry)>
                                            {{ $industry }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('industry')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="size" class="block text-xs text-gray-500 mb-1.5">Company size</label>
                                <select name="size" id="size"
                                    class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('size') border-red-300 @enderror">
                                    <option value="">Select size</option>
                                    @foreach (['1-10', '11-50', '51-200', '201-500', '501-1000', '1000+'] as $size)
                                        <option value="{{ $size }}" @selected(old('size', $company->size) == $size)>
                                            {{ $size }} employees
                                        </option>
                                    @endforeach
                                </select>
                                @error('size')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-xs text-gray-500 mb-1.5">Website</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m-15.432 0A8.959 8.959 0 013 12c0-.778.099-1.533.284-2.253" />
                                </svg>
                                <input type="url" name="website" id="website"
                                    value="{{ old('website', $company->website) }}" placeholder="https://example.com"
                                    class="w-full text-sm border border-gray-200 rounded-lg pl-9 pr-3 py-2.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('website') border-red-300 @enderror">
                            </div>
                            @error('website')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Country / City  -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div>
                                <label for="country" class="block text-xs text-gray-500 mb-1.5">Country</label>
                                <input type="text" name="country" id="country"
                                    value="{{ old('country', $company->country) }}" placeholder="e.g. Morocco"
                                    class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('country') border-red-300 @enderror">
                                @error('country')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="city" class="block text-xs text-gray-500 mb-1.5">City</label>
                                <input type="text" name="city" id="city"
                                    value="{{ old('city', $company->city) }}" placeholder="e.g. Casablanca"
                                    class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('city') border-red-300 @enderror">
                                @error('city')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Description  -->
                        <div>
                            <label for="description" class="block text-xs text-gray-500 mb-1.5">Description</label>
                            <textarea name="description" id="description" rows="5" maxlength="500"
                                placeholder="Tell candidates what your company does and what makes it a great place to work..."
                                oninput="document.getElementById('desc-counter').textContent = this.value.length"
                                class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-900 placeholder-gray-400 leading-relaxed resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-300 @enderror">{{ old('description', $company->description) }}</textarea>
                            <p class="text-xs text-gray-400 mt-1 text-right">
                                <span
                                    id="desc-counter">{{ strlen(old('description', $company->description ?? '')) }}</span>
                                / 500
                            </p>
                            @error('description')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- ==================== ACTIONS ====================  -->
                <div class="flex justify-end gap-3 pb-8">
                    <a href="#"
                        class="text-sm border border-gray-200 rounded-lg px-5 py-2.5 text-gray-600 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="text-sm bg-blue-600 text-white rounded-lg px-5 py-2.5 hover:bg-blue-700 transition">
                        Save changes
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- Logo live preview  -->
    <script>
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('logo-preview');
                const placeholder = document.getElementById('logo-placeholder');

                preview.src = event.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection

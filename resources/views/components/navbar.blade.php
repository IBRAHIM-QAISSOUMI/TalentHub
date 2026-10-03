<nav class="bg-white border-b border-gray-200 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-3 md:px-4">

        <div class="flex justify-between items-center h-14 md:h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <span class="text-xl md:text-2xl font-bold text-blue-600">
                    TalentHub
                </span>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-6">

                <a href="{{ route('friends.received-requests') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Friends
                </a>

                <a href="{{ auth()->user()->hasRole('candidate')
                            ? route('candidate.show')
                            : route('company.show') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Profile
                </a>

                <a href="{{ auth()->user()->hasRole('candidate')
                            ? route('Jobs-listings')
                            : route('jobs.index', ['id' => auth()->id()] )}}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Jobs
                </a>

                <a href="{{ route('applications.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Applications
                </a>

            </div>

            <!-- Desktop Right -->
            <div class="hidden md:flex items-center gap-3">

                <livewire:notifications />

                <livewire:navbar-search />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>

            </div>

            <!-- Mobile -->
            <div class="flex md:hidden items-center gap-2">

                <livewire:notifications />

                <button
                    @click="open = !open"
                    class="p-1.5 rounded-lg text-gray-700 hover:bg-gray-100">

                    <svg
                        x-show="!open"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg
                        x-show="open"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>

            </div>

        </div>

        <!-- Mobile Menu -->
        <div
            x-show="open"
            x-cloak
            x-transition
            class="md:hidden py-3 space-y-2 border-t">

            <a href="{{ route('friends.received-requests') }}"
               class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                Friends
            </a>

            <a href="{{ auth()->user()->hasRole('candidate')
                        ? route('candidate.show')
                        : route('company.show') }}"
               class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                Profile
            </a>

            <a href="{{ route('Jobs-listings') }}"
               class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                Jobs
            </a>

            <a href="{{ route('applications.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                Applications
            </a>

            <div class="pt-2">
                <livewire:navbar-search />
            </div>

            <form method="POST" action="{{ route('logout') }}" class="pt-2">
                @csrf

                <button
                    class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>

        </div>

    </div>
</nav>
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <span class="text-2xl font-bold text-blue-600">
                    TalentHub
                </span>
            </div>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8">

                <a href="/candidate"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Dashboard
                </a>

                <a href="/candidate/profile/edit"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Profile
                </a>

                <a href="{{route('Jobs-listings')}}"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Jobs
                </a>

                <a href="#"
                   class="text-gray-700 hover:text-blue-600 font-medium transition">
                    Applications
                </a>
            </div>

            <!-- User -->
            <div class="flex items-center gap-4">

                <a  href="{{route('candidate.show', auth()->user()->id)}}"
                    class="hidden sm:block text-gray-600">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>
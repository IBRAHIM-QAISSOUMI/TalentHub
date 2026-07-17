<div class="relative">
    <input
        type="text"
        wire:model.live.debounce.300ms="search"
        placeholder="Search candidates, companies ..."
        class="w-80 rounded-lg border px-4 py-1.5 focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-transparent"
    >

    @if(strlen($search) >= 2)
        <div class="absolute left-0 right-0 mt-2 bg-white border rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto">

            <!-- Candidates -->
            @if($this->results['users']->isNotEmpty())
                <div class="px-4 py-2 text-xs font-bold text-gray-500 bg-gray-100">
                    Candidates
                </div>

                @foreach($this->results['users'] as $user)
                    <a
                        href="{{ route('candidate.show', $user->id) }}"
                        class="block px-4 py-2 hover:bg-gray-100"
                    >
                        👤 {{ $user->name }}
                    </a>
                @endforeach
            @endif

            <!-- Companies -->
            @if($this->results['companies']->isNotEmpty())
                <div class="px-4 py-2 text-xs font-bold text-gray-500 bg-gray-100">
                    Companies
                </div>

                @foreach($this->results['companies'] as $company)
                    <a
                        href="{{ route('company.show', $company->id) }}"
                        class="block px-4 py-2 hover:bg-gray-100"
                    >
                        🏢 {{ $company->name }}
                    </a>
                @endforeach
            @endif

            @if(
                $this->results['users']->isEmpty() &&
                $this->results['companies']->isEmpty()
            )
                <div class="px-4 py-2 text-gray-500">
                    No results found.
                </div>
            @endif

        </div>
    @endif
</div>
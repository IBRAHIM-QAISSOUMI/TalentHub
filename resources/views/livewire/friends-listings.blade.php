<div>
    <!-- Tabs -->
    <div class="flex gap-3 mb-6">
        @foreach(['friends' => 'Friends', 'received' => 'Received', 'sent' => 'Sent'] as $value => $label)
        <label class="cursor-pointer">
            <input type="radio" name="filter" value="{{ $value }}" wire:model.live="filter" class="peer hidden">
            <div class="px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-700 text-sm font-medium transition hover:bg-gray-50 peer-checked:bg-blue-50 peer-checked:border-blue-600 peer-checked:text-blue-700">
                {{ $label }}
            </div>
        </label>
        @endforeach
    </div>

    <!-- Listing -->
    <div class="divide-y divide-gray-100 rounded-2xl border border-gray-200 bg-white overflow-hidden">

        @forelse($this->requests as $item)

            {{-- ============ FRIENDS ============ --}}
            @if($filter === '' || $filter === 'friends')
                @php
                    $friend = $item->friend();
                @endphp
                
                <div class="flex items-center gap-4 px-5 py-4">
                    {{-- Avatar --}}
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                        {{ strtoupper(substr($friend->name, 0, 2)) }}
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $friend->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Friends since {{ $item->updated_at->diffForHumans() }}</p>
                    </div>
                    {{-- Actions --}}
                    <form method="post" action="{{route('friend.reject', $friend)}}">
                       @csrf
                       @method('delete')
                       <button type="submit"
                          onclick="return confirm('Do you want to unfriend?')"
                          class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-red-500 border border-gray-200 hover:border-red-300 px-3 py-1.5 rounded-lg transition">
                          Remove
                       </button>
                    </form>
                </div>

            {{-- ============ RECEIVED ============ --}}
            @elseif($filter === 'received')
                <div class="flex items-center gap-4 px-5 py-4">
                    <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                        {{ strtoupper(substr($item->sender->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $item->sender->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Sent {{ $item->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex-row md:flex md:gap-2 ">
                        <form method="post" action="{{route('friend.accept', $item->sender)}}">
                          @csrf
                          @method('patch')
                          <button type="submit"
                             class="flex items-center gap-1.5 text-xs font-medium bg-gray-900 text-white px-4 py-1.5 rounded-lg hover:bg-gray-700 transition">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                             </svg>
                             Accept
                          </button>
                        </form>
                        <form method="post" action="{{route('friend.reject', $item->sender)}}">
                          @csrf
                          @method('delete')
                          <button type="submit"
                             class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-500 border border-gray-200 px-4 py-1.5 rounded-lg hover:bg-gray-50 transition">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                             </svg>
                             Decline
                          </button>
                        </form>
                    </div>
                </div>

            {{-- ============ SENT ============ --}}
            @elseif($filter === 'sent')
                <div class="flex items-center gap-4 px-5 py-4">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                        {{ strtoupper(substr($item->receiver->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $item->receiver->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Sent {{ $item->created_at->diffForHumans() }}</p>
                    </div>
                    <form method="post" action="{{route('friend.reject', $item->receiver)}}">
                      @csrf
                      @method('delete')
                      <button type="submit"
                         class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-500 border border-gray-200 px-4 py-1.5 rounded-lg hover:bg-gray-50 transition">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                         </svg>
                         Cancel
                      </button>
                    </form>
                </div>
            @endif

        @empty
            <div class="py-16 text-center">
                <p class="text-sm text-gray-400">
                    @if($filter === 'received') No pending requests
                    @elseif($filter === 'sent') No sent requests
                    @else No friends yet
                    @endif
                </p>
            </div>
        @endforelse

    </div>
</div>
   <!-- end requests listing -->
</div>

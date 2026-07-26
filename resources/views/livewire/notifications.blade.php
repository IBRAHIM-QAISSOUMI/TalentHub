<div class="relative" x-data="{ open: @entangle('showNotifications') }" @click.outside="open = false">

    {{-- Bell button --}}
    <button
        wire:click="toggleNotifications"
        class="relative flex items-center justify-center w-10 h-10 rounded-full text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors duration-150 focus:outline-none"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.65V5a2 2 0 10-4 0v.35A6 6 0 006 11v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 flex items-center justify-center min-w-[20px] h-5 px-1 text-[11px] font-semibold text-white bg-red-500 rounded-full ring-2 ring-white animate-pulse">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 z-50 mt-3 w-96 max-w-[90vw] bg-white rounded-2xl shadow-xl ring-1 ring-black/5 overflow-hidden"
        style="display: none;"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Notifications</h3>
            @if($unreadCount > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors"
                >
                    Mark all as read
                </button>
            @endif
        </div>

        {{-- List --}}
        <div class="max-h-[26rem] overflow-y-auto divide-y divide-gray-50">
            @forelse($this->notifications as $notification)
                <div
                    wire:click="markAsRead('{{ $notification->id }}')"
                    wire:key="{{ $notification->id }}"
                    class="flex items-start gap-3 px-4 py-3 cursor-pointer transition-colors hover:bg-gray-50 {{ is_null($notification->read_at) ? 'bg-blue-50/40' : '' }}"
                >
                    {{-- Icon --}}
                    <div class="flex-shrink-0 flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-700 leading-snug {{ is_null($notification->read_at) ? 'font-medium text-gray-900' : '' }}">
                            {{ $notification->data['message'] ?? 'New notification' }}
                        </p>
                        <span class="text-xs text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Unread dot --}}
                    @if(is_null($notification->read_at))
                        <span class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></span>
                    @endif
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-10 px-4 text-center">
                    <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.65V5a2 2 0 10-4 0v.35A6 6 0 006 11v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>
                    <p class="text-sm text-gray-400">You don't have any notifications yet</p>
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        @if($this->notifications->isNotEmpty())
            <div class="px-4 py-2.5 border-t border-gray-100 text-center">
                <a href="#" class="text-xs font-medium text-blue-600 hover:text-blue-800">
                    View all notifications
                </a>
            </div>
        @endif
    </div>
</div>
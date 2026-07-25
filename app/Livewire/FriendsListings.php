<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Friendship;

class FriendsListings extends Component
{
    public string $filter = '';

    public function getRequestsProperty() {

        if($this->filter === '' || $this->filter === "friends") {
            return Friendship::where('status', 'accepted')
                ->where(function ($query) {
                    $query->where('sender_id', auth()->id())
                          ->orWhere('receiver_id', auth()->id());
                })
                ->with(['sender', 'receiver'])
                ->latest()
                ->get();
        
        } elseif($this->filter === 'received') {
            return auth()->user()
                ->receivedFriendRequests()
                ->where('status', 'pending')
                ->with('sender')
                ->latest()
                ->get();

        } elseif($this->filter === 'sent') {
            return auth()->user()
                ->sentFriendRequests()
                ->where('status', 'pending')
                ->with('receiver')
                ->latest()
                ->get();
        }

         return collect();
    }


    public function render()
    {
        return view('livewire.friends-listings');
    }
}

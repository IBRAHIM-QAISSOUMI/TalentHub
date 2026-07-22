<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;

class FriendshipController extends Controller
{

    public function send(User $user)
    {
        // Prevent users from sending a friend request to themselves
        if (auth()->id() == $user->id) {
            return back()->with('error', 'You cannot send a friend request to yourself.');
        }
    
        // Check if a friend request or friendship already exists
        $exists = Friendship::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
        })->exists();
    
        // Prevent duplicate friend requests
        if ($exists) {
            return back()->with('error', 'Friend request already exists.');
        }
    
        // Create a new friend request
        Friendship::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'status' => 'pending',
        ]);
    
        // Redirect back with a success message
        return back()->with('success', 'Friend request sent successfully.');
    }



    public function reject(User $user) {

        $friendship = Friendship::where(function ($q) use ($user) {
            $q->where('sender_id',  auth()->id())
              ->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('receiver_id', auth()->id())
              ->where('sender_id', $user->id);
        })->firstOrFail();

        $friendship->delete();

        return back()->with('success', 'Friend request removed successfully.');
    }
    

    public function accept(User $user) {

        $friendship = Friendship::where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());

        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted successfully.');
    }

}

<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public bool $showNotifications = false;
    public $unreadCount = 0;

    protected $listeners = ['notificationReceived' => 'refreshCount'];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        $this->unreadCount = auth()->user()
            ->unreadNotifications()
            ->count();
    }

    public function toggleNotifications()
    {
        $this->showNotifications = ! $this->showNotifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $notificationId)
            ->first();

        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
            $this->refreshCount();
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->refreshCount();
    }

    public function getNotificationsProperty()
    {
        return auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
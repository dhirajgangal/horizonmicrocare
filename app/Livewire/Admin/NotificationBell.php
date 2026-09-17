<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class NotificationBell extends Component
{
    public function markRead(string $notificationId): void
    {
        auth()->user()?->notifications()->whereKey($notificationId)->first()?->markAsRead();
    }

    public function markAllRead(): void
    {
        auth()->user()?->unreadNotifications->markAsRead();
    }

    public function render(): View
    {
        $user = auth()->user();

        return view('livewire.admin.notification-bell', [
            'unread' => $user?->unreadNotifications ?? collect(),
        ]);
    }
}

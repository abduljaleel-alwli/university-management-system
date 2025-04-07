<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AdminNotifications extends Component
{
    use WithPagination;

    public $filter = 'all'; // يمكن أن يكون 'all' أو 'unread' أو 'read'

    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage(); // إعادة الصفحة إلى الأولى عند تغيير الفلتر
    }


    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->dispatch('refreshNotifications'); // تحديث القائمة عند التحديث
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->dispatch('refreshNotifications');
    }

    public function getNotificationsProperty()
    {
        $query = Auth::user()->notifications();

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'read') {
            $query->whereNotNull('read_at');
        }

        return $query->latest()->paginate(10); // تحديد عدد الإشعارات لكل صفحة
    }


    public function render()
    {
        $notifications = $this->notifications;


        return view('livewire.admin-notifications', [
            'notifications' => $notifications,
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SuperAdminUsers extends Component
{
    use WithPagination;

    public $search = [
        'name' => '',
        'email' => '',
    ];

    protected $queryString = ['search'];

    public function mount()
    {
        if (!Auth::user()->hasRole('super-admin')) {
            abort(403, __('You don’t have permission.'));
        }
    }

    // إعادة تعيين الصفحة عند تغيير البحث
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // استعلام البحث وجلب المستخدمين مع الترقيم
    public function getUsersProperty()
    {
        $query = User::query();

        if (!empty($this->search['name'])) {
            $query->where('name', 'like', "%{$this->search['name']}%");
        }

        if (!empty($this->search['email'])) {
            $query->where('email', 'like', "%{$this->search['email']}%");
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.super-admin-users', [
            'users' => $this->users,  // Livewire يستدعي getUsersProperty تلقائيًا
        ]);
    }
}

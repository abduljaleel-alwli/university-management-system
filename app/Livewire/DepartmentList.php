<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class DepartmentList extends Component
{
    use WithPagination;

    public $search = '';
    public $departments;
    protected $listeners = ['refreshDepartments' => 'loadDepartments'];

    // تحميل جميع الأقسام عند البداية
    public function mount()
    {
        $this->loadDepartments();
    }

    // تحميل الأقسام بناءً على البحث
    public function searchDepartments()
    {
        $this->departments = Department::where('name_ar', 'like', "%{$this->search}%")
            ->orWhere('name_en', 'like', "%{$this->search}%")
            ->get();
    }

    // إعادة تحميل جميع الأقسام
    public function loadDepartments()
    {
        $this->departments = Department::all();
    }

    public function render()
    {
        return view('livewire.department-list');
    }
}

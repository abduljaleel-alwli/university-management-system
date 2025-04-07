<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SpecializationType;
use Livewire\WithPagination;

class SpecializationList extends Component
{
    use WithPagination;

    public $search = '';
    public $specializations;
    protected $listeners = ['refreshSpecializations' => 'loadSpecializations'];

    // تحميل جميع الأقسام عند البداية
    public function mount()
    {
        $this->loadSpecializations();
    }

    // تحميل الأقسام بناءً على البحث
    public function searchSpecializations()
    {
        $this->specializations = SpecializationType::where('name_ar', 'like', "%{$this->search}%")
            ->orWhere('name_en', 'like', "%{$this->search}%")
            ->get();
    }

    // إعادة تحميل جميع الأقسام 
    public function loadSpecializations()
    {
        $this->specializations = SpecializationType::all();
    }

    public function render()
    {
        return view('livewire.specialization-list');
    }
}

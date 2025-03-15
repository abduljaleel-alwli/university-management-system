<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;

class DepartmentForm extends Component
{
    public $name_ar, $name_en, $department_id;
    public $modalOpen = false;
    public $confirmDeleteModal = false;
    public $departmentToDelete;


    protected $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
    ];


    protected $listeners = ['openModal', 'confirmDelete'];

    public function openModal($departmentId = null)
    {
        $this->resetValidation();
        $this->reset();

        if ($departmentId) {
            $department = Department::findOrFail($departmentId);
            $this->department_id = $department->id;
            $this->name_ar = $department->name_ar;
            $this->name_en = $department->name_en;
        }

        $this->modalOpen = true;
    }

    public function confirmDelete($departmentId)
    {
        $this->departmentToDelete = $departmentId;
        $this->confirmDeleteModal = true;
    }

    public function deleteDepartment()
    {
        if ($this->departmentToDelete) {
            Department::findOrFail($this->departmentToDelete)->delete();
            session()->flash('message', __('Department deleted successfully'));
        }

        $this->confirmDeleteModal = false;
        $this->dispatch('refreshDepartments');
    }

    public function save()
    {
        $this->validate();

        if ($this->department_id) {
            $department = Department::findOrFail($this->department_id);
            $department->update([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
            ]);
            session()->flash('message', __('The department has been successfully updated'));
        } else {
            Department::create([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
            ]);
            session()->flash('message', __('The department was created successfully'));
        }

        $this->modalOpen = false;
        $this->dispatch('refreshDepartments');
    }

    public function render()
    {
        return view('livewire.department-form');
    }
}

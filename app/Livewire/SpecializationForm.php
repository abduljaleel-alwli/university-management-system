<?php

namespace App\Livewire;

use App\Models\SpecializationType;
use Livewire\Component;

class SpecializationForm extends Component
{
    public $name_ar, $name_en, $specialization_id;
    public $modalOpen = false;
    public $confirmDeleteModal = false;
    public $specializationToDelete;


    protected $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
    ];


    protected $listeners = ['openModal', 'confirmDelete'];

    public function openModal($specializationId = null)
    {
        $this->resetValidation();
        $this->reset();

        if ($specializationId) {
            $specialization = SpecializationType::findOrFail($specializationId);
            $this->specialization_id = $specialization->id;
            $this->name_ar = $specialization->name_ar;
            $this->name_en = $specialization->name_en;
        }

        $this->modalOpen = true;
    }

    public function confirmDelete($specializationId)
    {
        $this->specializationToDelete = $specializationId;
        $this->confirmDeleteModal = true;
    }

    public function deleteSpecialization()
    {
        if ($this->specializationToDelete) {
            SpecializationType::findOrFail($this->specializationToDelete)->delete();
            session()->flash('success', __('Specialization deleted successfully!'));
        }

        $this->confirmDeleteModal = false;
        $this->dispatch('refreshSpecializations');
    }

    public function save()
    {
        $this->validate();

        if ($this->specialization_id) {
            $specialization = SpecializationType::findOrFail($this->specialization_id);
            $specialization->update([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
            ]);
            session()->flash('success', __('Specialization updated successfully!'));
        } else {
            SpecializationType::create([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
            ]);
            session()->flash('success', __('Specialization created successfully!'));
        }

        $this->modalOpen = false;
        $this->dispatch('refreshSpecializations');
    }

    public function render()
    {
        return view('livewire.specialization-form');
    }
}

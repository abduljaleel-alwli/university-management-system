<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Researches;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CreateResearch extends Component
{

    use WithPagination;

    public $title_ar;
    public $title_en;
    public $student_id;
    public $journal_name;
    public $journal_url;
    public $publication_date;
    public $research_url;
    public $notes;
    public $status;

    public $search = [
        'first_name' => '',
        'father_name' => '',
        'grandfather_name' => '',
        'last_name' => '',
        'email' => '',
        'phone_number' => '',
        'study_type' => '',
        'admission_channel' => '',
        'academic_stage' => '',
        'status' => '',
        'start_date' => '',
        'study_end_date' => '',
    ];

    protected $queryString = ['search'];


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getStudentsProperty()
    {
        $user = Auth::user();
        $query = Student::query()->where('department_id', $user->department_id);

        foreach ($this->search as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                    $query->where(function ($q) use ($key, $value) {
                        $q->where($key . '_ar', 'like', "%{$value}%")
                          ->orWhere($key . '_en', 'like', "%{$value}%");
                    });
                } elseif (in_array($key, ['email', 'phone_number'])) {
                    $query->where($key, 'like', "%{$value}%");
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'status'])) {
                    $query->where($key, $value);
                } elseif ($key === 'start_date') {
                    $query->whereDate('start_date', '>=', $value);
                } elseif ($key === 'study_end_date') {
                    $query->whereDate('study_end_date', '<=', $value);
                }
            }
        }

        return $query->paginate(10);
    }

    public function save()
    {
        $this->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'journal_name' => 'required|string|max:255',
            'journal_url' => 'nullable|url',
            'publication_date' => 'required|date',
            'research_url' => 'nullable|url',
            'notes' => 'nullable|string',
            'status' => 'required|in:published,accepted',
        ]);

        $user = Auth::user();
        $student = Student::findOrFail($this->student_id);

        if ($student->department_id !== $user->department_id) {
            session()->flash('error', __('You are not authorized to add research for this student.'));
            return;
        }

        Researches::create([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'student_id' => $this->student_id,
            'department_id' => $user->department_id,
            'journal_name' => $this->journal_name,
            'journal_url' => $this->journal_url,
            'publication_date' => $this->publication_date,
            'research_url' => $this->research_url,
            'notes' => $this->notes,
            'status' => $this->status,
            'author_id' => $user->id,
            'editor_id' => null,
        ]);

        session()->flash('success', __('Search added successfully!'));
        return redirect()->route('admin.researches.index');
    }

    public function render()
    {
        return view('livewire.create-research', [
            'students' => $this->students,
        ]);
    }
}

<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    protected $filters;
    protected $locale;

    public function __construct($filters)
    {
        $this->filters = $filters;
        $this->locale = app()->getLocale();
    }

    public function query()
    {
        return Student::query();

        $this->filters = array_filter($this->filters, fn($value) => $value !== null && $value !== '');

        foreach ($this->filters as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                    $query->where(function ($q) use ($key, $value) {
                        $q->where($key . '_ar', 'like', '%' . $value . '%')
                          ->orWhere($key . '_en', 'like', '%' . $value . '%');
                    });
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            __('Full Name'),
            __('Phone Number'),
            __('Email'),
            __('Study Type'),
            __('Admission Channel'),
            __('Academic Stage'),
            __('Status'),
            __('Specialization Type'),
            __('Start Date'),
            __('Study End Date'),
            __('First Extension Date'),
            __('Second Extension Date'),
            __('Notes'),
            __('Department'),
        ];
    }

    /**
     * @return \Maatwebsite\Excel\Concerns\WithMapping;
     */
    public function map($student): array
    {
        return [
            $student->full_name ?? __('Not Available'),
            $student->phone_number ?? __('Not Available'),
            $student->email ?? __('Not Available'),
            $student->study_type_translated ?? __('Not Available'),  // استخدام القيم المترجمة
            $student->admission_channel_translated ?? __('Not Available'),
            $student->academic_stage_translated ?? __('Not Available'),
            $student->status_translated ?? __('Not Available'),
            $student->specialization_type_translated ?? __('Not Available'),
            $student->start_date ?? __('Not Available'),
            $student->study_end_date ?? __('Not Available'),
            $student->first_extension_date ?? __('Not Available'),
            $student->second_extension_date ?? __('Not Available'),
            $student->notes ?? __('Not Available'),
            $student->department->name ?? __('Not Available'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // جعل الصف الأول (العناوين) بخط عريض
        ];
    }
}

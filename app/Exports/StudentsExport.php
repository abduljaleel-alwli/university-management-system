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

        $query = Student::query();

        $this->filters = array_filter($this->filters, fn($value) => $value !== null && $value !== '');

        foreach ($this->filters as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                    $query->where(function ($q) use ($key, $value) {
                        $q->where($key . '_ar', 'like', "%{$value}%")
                            ->orWhere($key . '_en', 'like', "%{$value}%");
                    });
                } elseif (in_array($key, ['email', 'phone_number'])) {
                    $query->where($key, 'like', "%{$value}%");
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'department_id'])) {
                    $query->where($key, $value);
                } elseif ($key === 'status') {
                    if (in_array($value, ['active', 'suspended', 'pending_review'])) {
                        $query->where('status', $value)
                            ->whereDoesntHave('postGraduationStep'); // ✅ تأكد من عدم وجود بيانات في post_graduation_steps;
                    } elseif ($value === 'pending_review') {
                        $query->where(function ($q) {
                            $q->where('status', 'pending_review')
                                ->whereDoesntHave('postGraduationStep') // ✅ الطلاب الذين لم يدخلوا مرحلة ما بعد التخرج
                                ->orWhereHas('postGraduationStep', function ($subQuery) {
                                    $subQuery->where('post_graduation_status', 'pending_review'); // ✅ الطلاب الذين لديهم post_graduation_status = pending_review
                                });
                        });
                    } elseif (in_array($value, ['graduate', 'fail',])) {
                        $query->whereHas('postGraduationStep', function ($q) use ($value) {
                            $q->where('post_graduation_status', $value);
                        });
                    }
                } elseif ($key === 'start_date') {
                    $query->whereDate('start_date', '>=', $value);
                } elseif ($key === 'study_end_date') {
                    $query->whereDate('study_end_date', '<=', $value);
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
        // التحقق من وجود postGraduationStep واستخدام الحالة الخاصة به إذا كانت موجودة
        $status = $student->postGraduationStep
            ? __($student->postGraduationStep->status_translated)
            : $student->status_translated;

        return [
            $student->full_name ?? __('Not Available'),
            $student->phone_number ?? __('Not Available'),
            $student->email ?? __('Not Available'),
            $student->study_type_translated ?? __('Not Available'),  // استخدام القيم المترجمة
            $student->admission_channel_translated ?? __('Not Available'),
            $student->academic_stage_translated ?? __('Not Available'),
            $status ?? __('Not Available'),
            $student->specializationType->name ?? __('Not Available'),
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

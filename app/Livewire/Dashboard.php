<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Department;
use App\Models\Payment;
use App\Models\PostGraduationStep;
use App\Models\Researches;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{

    public $latestNotifications;
    public $totalSuperAdmins;
    public $totalAdmins;
    public $latestUsers;
    public $totalStudents;
    public $studentsPerDepartment;
    public $researchCounts = [];
    public $totalPaymentsIQD;
    public $totalPaymentsUSD;
    public $studentsByStatus;
    public $latestStudents;
    public $latestResearches;
    public $latestPayments;
    public $totalGraduatedStudents;
    public $totalFailedStudents;


    public function mount()
    {
        $user = Auth::user(); // جلب المستخدم الحالي

        // جلب الإشعارات الخاصة بالمستخدم فقط
        $this->latestNotifications = $user->notifications()->latest()->take(10)->get();

        if ($user->hasRole('super-admin')) {
            // عدد المستخدمين لكل دور
            $this->totalSuperAdmins = User::role('super-admin')->count();
            $this->totalAdmins = User::role('admin')->count();

            // آخر المستخدمين المضافين
            $this->latestUsers = User::latest()->take(5)->get();
            // Super Admin يرى كل البيانات
            $this->totalStudents = Student::count();
            $this->studentsPerDepartment = Department::withCount('student')->get();
            $this->researchCounts = Researches::selectRaw("status, COUNT(*) as count")
                ->groupBy('status')->get()->pluck('count', 'status');
            $this->totalPaymentsIQD = Payment::where('currency', 'IQD')->sum('amount');
            $this->totalPaymentsUSD = Payment::where('currency', 'USD')->sum('amount');

            $this->studentsByStatus = DB::table('students')
                ->leftJoin('post_graduation_steps', 'students.id', '=', 'post_graduation_steps.student_id')
                ->selectRaw("
                        CASE
                            WHEN post_graduation_steps.id IS NOT NULL THEN post_graduation_steps.post_graduation_status
                            ELSE students.status
                        END AS final_status,
                        COUNT(*) as count
                    ")
                ->groupBy('final_status')
                ->pluck('count', 'final_status');

            $this->latestStudents = Student::latest()->take(5)->get();
            $this->latestResearches = Researches::latest()->take(5)->get();
            $this->latestPayments = Payment::latest()->take(5)->get();
            $this->totalGraduatedStudents = PostGraduationStep::where('post_graduation_status', 'graduate')->count();
            $this->totalFailedStudents = PostGraduationStep::where('post_graduation_status', 'fail')->count();
        } else if ($user->hasRole('admin')) {
            // Admin يرى فقط بيانات قسمه
            $departmentId = $user->department_id; // يفترض أن admin لديه معرف القسم

            $this->totalStudents = Student::where('department_id', $departmentId)->count();
            $this->studentsPerDepartment = Department::where('id', $departmentId)
                ->withCount('student')->get();
            $this->researchCounts = Researches::whereHas('student', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->selectRaw("status, COUNT(*) as count")
                ->groupBy('status')->get()->pluck('count', 'status');
            $this->totalPaymentsIQD = Payment::where('currency', 'IQD')
                ->whereHas('student', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->sum('amount');
            $this->totalPaymentsUSD = Payment::where('currency', 'USD')
                ->whereHas('student', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->sum('amount');

            $this->studentsByStatus = DB::table('students')
                ->leftJoin('post_graduation_steps', 'students.id', '=', 'post_graduation_steps.student_id')
                ->where('students.department_id', $departmentId)
                ->selectRaw("
                        CASE
                            WHEN post_graduation_steps.id IS NOT NULL THEN post_graduation_steps.post_graduation_status
                            ELSE students.status
                        END AS final_status,
                        COUNT(*) as count
                    ")
                ->groupBy('final_status')
                ->pluck('count', 'final_status');

            $this->latestStudents = Student::where('department_id', $departmentId)->latest()->take(5)->get();
            $this->latestResearches = Researches::whereHas('student', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->latest()->take(5)->get();
            $this->latestPayments = Payment::whereHas('student', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->latest()->take(5)->get();
            $this->totalGraduatedStudents = PostGraduationStep::whereHas('student', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->where('post_graduation_status', 'graduate')->count();
            $this->totalFailedStudents = PostGraduationStep::whereHas('student', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->where('post_graduation_status', 'fail')->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

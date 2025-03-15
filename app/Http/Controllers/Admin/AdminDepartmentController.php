<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDepartmentController extends Controller
{
    // ---> Show Student With Status
    public function status(Department $department, $status)
    {

        $user = Auth::user();

        // التحقق من صلاحيات الـ Admin
        if ($user->hasRole('admin') && $department->id !== $user->department_id ) {
            abort(403, __('You don’t have permission.'));
        }

        // التحقق من أن الحالة صحيحة
        if (!in_array($status, ['active', 'fail', 'graduate'])) {
            abort(404);
        }

        // جلب الطلاب بناءً على الحالة
        if ($status === 'active') {
            $students = $department->activeStudents()->paginate(15);
            $title =  __('Continuing students in') . ": {$department->name}";
        } elseif ($status === 'fail') {
            $students = $department->failedStudents()->paginate(15);
            $title = __('Students failing in') . ": {$department->name}";
        } else {
            $students = $department->graduatedStudents()->paginate(15);
            $title = __('Graduate students in') . ": {$department->name}";
        }

        return view('panel.admin.department.status', compact('students', 'title', 'department', 'status'));
    }
}

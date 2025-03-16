<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    // --> عرض الأقسام
    public function index()
    {
        return view('panel.super-admin.department.index');
    }

    public function refresh()
    {
        $departments = Department::all();
        return response()->json($departments);
    }


    // --> تخزين القسم الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $department = Department::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        return response()->json(['message' => __('Department created successfully!'), 'department' => $department], 201);
    }


    // --> show
    public function show(string $id)
    {
        // التحقق من وجود القسم (اختياري، إذا كنت تريد التأكد من صحة department_id)
        $department = Department::find($id);
        if (!$department) {
            abort(404, 'The partition does not exist.');
        }

        // جلب الطلاب الذين ينتمون إلى القسم مع التقسيم (pagination)
        $students = Student::where('department_id', $id)->paginate(15);

        // إرجاع العرض مع بيانات الطلاب
        return view('panel.super-admin.student.department', ['students' => $students, 'department' => $department]);
    }


    // --> تحديث القسم
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        return response()->json(['message' => 'Department updated successfully!', 'department' => $department]);
    }


    // --> حذف القسم
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['message' => __('Department deleted successfully!')]);
    }

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

        return view('panel.super-admin.department.status', compact('students', 'title', 'department', 'status'));
    }

}

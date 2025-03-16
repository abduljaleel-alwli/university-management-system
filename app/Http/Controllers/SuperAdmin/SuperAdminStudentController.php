<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminStudentController extends Controller
{
    // --> index
    public function index()
    {
        return view('panel.super-admin.student.index');
    }


    // --> show
    public function show(string $id)
    {
        $user = Auth::user();

        // البحث عن الطالب باستخدام `find` والتحقق من department_id
        $student = Student::find($id);

        // إذا لم يتم العثور على الطالب، قم بإرجاع رد 404
        if (!$student) {
            abort(404, __('The student does not exist.'));
        }

        // إرجاع عرض التعديل مع بيانات الطالب
        return view('panel.super-admin.student.show', compact('student'));
    }
}

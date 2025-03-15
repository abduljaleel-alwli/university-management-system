<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PostGraduationStep;
use Illuminate\Support\Facades\Auth;

class PostGraduationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // إذا كان المستخدم Super Admin، يعرض كل البيانات
        if ($user->hasRole('super-admin')) {
            $steps = PostGraduationStep::with('student')->paginate(10);
        }
        // إذا كان المستخدم Admin، يعرض فقط بيانات القسم الذي يشرف عليه
        elseif ($user->hasRole('admin')) {
            $steps = PostGraduationStep::whereHas('student', function ($query) use ($user) {
                $query->where('department_id', $user->department_id);
            })->with('student')->paginate(10);
        }
        // منع الوصول للمستخدمين غير المصرح لهم
        else {
            abort(403, 'غير مصرح لك بعرض هذه البيانات.');
        }

        return view('panel.super-admin.post-graduation.index', compact('steps'));
    }


    // --> عرض تفاصيل طالب معين في مراحل ما بعد الدراسة.
    public function show($id)
    {
        $user = Auth::user();
        $PostGraduationStep = PostGraduationStep::findOrFail($id);

        // السماح لـ Super Admin أو Admin مسؤول عن نفس القسم فقط بعرض البيانات
        if (
            $user->hasRole('super-admin') ||
            ($user->hasRole('admin') && $PostGraduationStep->student->department_id === $user->department_id)
        ) {
            return view('panel.super-admin.post-graduation.show', compact('PostGraduationStep'));
        }

        abort(403, 'غير مصرح لك بعرض هذه البيانات.');
    }
}

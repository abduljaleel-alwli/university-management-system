<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecializationType;
use Illuminate\Http\Request;

class SpecializationTypeController extends Controller
{
    // --> عرض الأقسام
    public function index()
    {
        return view('panel.super-admin.specialization-type.index');
    }

    public function refresh()
    {
        $specialization_type = SpecializationType::all();
        return response()->json($specialization_type);
    }


    // --> تخزين القسم الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $specialization_type = SpecializationType::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        return response()->json(['message' => __('Department created successfully!'), 'department' => $specialization_type], 201);
    }


    // --> show
    public function show(string $id)
    {
        // التحقق من وجود القسم (اختياري، إذا كنت تريد التأكد من صحة department_id)
        $specialization_type = SpecializationType::find($id);
        if (!$specialization_type) {
            abort(404, 'The partition does not exist.');
        }

        // جلب الطلاب الذين ينتمون إلى القسم مع التقسيم (pagination)
        $students = Student::where('department_id', $id)->paginate(15);

        // إرجاع العرض مع بيانات الطلاب
        return view('panel.super-admin.student.specialization-type', ['students' => $students, 'department' => $specialization_type]);
    }


    // --> تحديث القسم
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $specialization_type = SpecializationType::findOrFail($id);
        $specialization_type->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        return response()->json(['message' => 'Department updated successfully!', 'department' => $specialization_type]);
    }


    // --> حذف القسم
    public function destroy($id)
    {
        $specialization_type = SpecializationType::findOrFail($id);
        $specialization_type->delete();

        return response()->json(['message' => __('Department deleted successfully!')]);
    }
}

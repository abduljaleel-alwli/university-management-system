<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Researches;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    // عرض جميع الأبحاث
    public function index()
    {
        return view('panel.admin.research.index');
    }

    // عرض نموذج إضافة بحث جديد
    public function create()
    {
        return view('panel.admin.research.create');
    }


    public function show($id)
    {
        return view('panel.admin.research.show', [
         'research_id' => $id
        ]);
    }

    public function edit(Researches $research)
    {
        $user = Auth::user();

        // التأكد من أن المستخدم لديه الصلاحية لتعديل البحث
        if ($research->department_id !== $user->department_id) {
            abort(403, __("You are not authorized to modify this search"));
        }

        // جلب قائمة الطلاب التابعين لنفس القسم فقط
        $students = Student::where('department_id', $user->department_id)->get();

        return view('panel.admin.research.edit', compact('research', 'students'));
    }


    public function update(Request $request, Researches $research)
    {
        $user = Auth::user();

        // التأكد من أن المستخدم لديه الصلاحية لتعديل البحث
        if ($research->department_id !== $user->department_id) {
            abort(403, __("You are not authorized to modify this search"));
        }

        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'journal_name' => 'required|string|max:255',
            'journal_url' => 'nullable|url',
            'publication_date' => 'required|date',
            'research_url' => 'nullable|url',
            'notes' => 'nullable|string',
            'status' => 'required|in:published,accepted',
        ]);

        // تحديث البيانات (مع منع تغيير `department_id` و `author_id`)
        $research->update($validatedData);

        return redirect()->route('admin.researches.index')->with('success', __("Search updated successfully"));
    }

    public function destroy(Researches $research)
    {
        $user = Auth::user();

        // التأكد من أن المستخدم لديه الصلاحية لحذف البحث
        if ($research->department_id !== $user->department_id) {
            abort(403, __("You are not authorized to delete this search"));
        }

        $research->delete();

        return redirect()->route('admin.researches.index')->with('success', __("Search deleted successfully"));
    }


    // --> Get Research with Status
    public function status($status){
        $user = Auth::user();

        $researches = Researches::where('department_id', $user->department_id)->where('status', $status)->paginate(15);
        return view('panel.admin.research.status', [
            'researches' => $researches,
            'status' => $status
        ]);
    }
}


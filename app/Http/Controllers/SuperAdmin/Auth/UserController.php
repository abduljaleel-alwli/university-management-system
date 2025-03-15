<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function index(): View
    {
        // جلب جميع المستخدمين مع أدوارهم
        // $users = User::with('roles', 'department')->get();
        // return view('panel.super-admin.admin.index', compact('users'));
        return view('panel.super-admin.admin.index');
    }

    /**
     * Show the registration form.
     */
    public function create(): View
    {
        $departments = Department::all(); // جلب جميع الأقسام
        $roles = Role::all();
        return view('panel.super-admin.admin.register', [
            'departments' => $departments,
            'roles' => $roles,
            'role' => 'admin', // تمرير الدور بشكل افتراضي
        ]);
    }

    public function store(Request $request)
    {
        // تحقق من البيانات
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => ['required', 'string', 'in:super-admin,admin'], // تأكد من أن الدور مسموح به
            'department_id' => [
                Rule::requiredIf($request->role === 'admin'), // مطلوب إذا كان الدور "admin"
                'nullable',
                'exists:departments,id',
            ],
        ]);

        // تعيين `department_id` إلى null إذا كان Super Admin
        if ($validatedData['role'] === 'super-admin') {
            $validatedData['department_id'] = null;
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'department_id' => $validatedData['department_id'] ?? null, // تعيين القسم إذا كان موجودًا
        ]);

        // تعيين الدور للمستخدم
        if (isset($validatedData['role']) && $validatedData['role'] == 'super-admin') {
            $user->assignRole('super-admin');
        } else {
            // تعيين الدور الافتراضي، يمكن أن يكون "user" أو غيره
            $user->assignRole('admin');
        }

        return redirect()->route('super-admin.admins.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // جلب جميع الأدوار
        $departments = Department::all(); // جلب جميع الأقسام

        return view('panel.super-admin.admin.edit', compact('user', 'roles', 'departments'))
        ->with('success', 'User registered successfully.');
    }

    public function update(Request $request, $id)
    {
        // جلب المستخدم من قاعدة البيانات
        $user = User::findOrFail($id);

        // تحقق من البيانات
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$id"], // تحقق من البريد الإلكتروني
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // كلمة المرور اختيارية
            'role' => ['required', 'string', 'in:super-admin,admin'],
            'department_id' => [
                Rule::requiredIf($request->role === 'admin'), // مطلوب إذا كان الدور "admin"
                'nullable',
                'exists:departments,id',
            ],
        ]);

        // تحديث البيانات
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'department_id' => ($validatedData['role'] === 'admin') ? $validatedData['department_id'] : null,
        ]);

        // إذا تم تقديم كلمة مرور جديدة
        if (!empty($validatedData['password'])) {
            $user->update(['password' => Hash::make($validatedData['password'])]);
        }

        // تحديث الدور
        $user->syncRoles([$validatedData['role']]);

        return redirect()->route('super-admin.admins.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        // العثور على المستخدم
        $user = User::findOrFail($id);

        // حذف المستخدم
        $user->delete();

        // إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('super-admin.admins.index')
            ->with('success', 'User deleted successfully.');
    }

}

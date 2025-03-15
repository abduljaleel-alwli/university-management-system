<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء الأدوار
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);

        // إنشاء الصلاحيات للسوبر أدمن
        $permissions = [
            'manage-admins',        // إدارة الإداريين (إضافة، تعديل، حذف)
            'manage-departments',   // إدارة الأقسام
            'view-all-data',        // رؤية جميع الأقسام والطلاب والإداريين
            'generate-reports',     // سحب التقارير
            'send-notifications',   // إرسال إشعارات للإداريين
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // منح جميع الصلاحيات لـ Super Admin
        $superAdmin->givePermissionTo(Permission::all());

        // إنشاء الصلاحيات للأدمن
        $adminPermissions = [
            'manage-students',     // متابعة وإدارة بيانات الطلاب
            'send-emails',         // إرسال رسائل بريد إلكتروني للطلاب
            'change-student-status', // تغيير حالة الطلاب (مستمر، مؤجل، خريج، راسب)
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // منح الصلاحيات للأدمن
        $admin->givePermissionTo($adminPermissions);
    }
}

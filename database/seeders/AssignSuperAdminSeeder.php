<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AssignSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم Super Admin إذا لم يكن موجودًا
        $superAdmin = User::firstOrCreate([
            'email' => 'super@gmail.com', // استبدل بالإيميل الصحيح
            'name' => 'Super Admin',
            'password' => Hash::make('Password'), // استبدل بكلمة مرور آمنة
        ]);

        // تعيين الأدوار للمستخدمين
        $superAdmin->assignRole('super-admin');

        echo "Super Admin created/updated successfully! \n";
    }
}

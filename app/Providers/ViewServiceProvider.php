<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Department;
use App\Models\Researches;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.sidebar', function ($view) {
            $user = Auth::user();

            if ($user->hasRole('super-admin')) {
                // جلب جميع الأقسام مع جميع الطلاب
                $departments = Department::with(['student.postGraduationStep'])->get();
            } elseif ($user->hasRole('admin')) {
                // جلب القسم الخاص بالمستخدم فقط
                $departments = Department::whereHas('user', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })->with(['student.postGraduationStep'])->get();
            } else {
                $departments = collect(); // مستخدم عادي لا يملك صلاحيات
            }

            // جلب عدد الأبحاث لكل حالة
            $adminPublishedResearchesCount = Researches::where('status', 'published')->where('department_id', $user->department_id)->count();
            $adminAcceptedResearchesCount = Researches::where('status', 'accepted')->where('department_id', $user->department_id)->count();

            $superPublishedResearchesCount = Researches::where('status', 'published')->count();
            $superAcceptedResearchesCount = Researches::where('status', 'accepted')->count();


            // تمرير القيم إلى الـ view
            $view->with([
                'departments' => $departments,
                'adminPublishedResearchesCount' => $adminPublishedResearchesCount,
                'adminAcceptedResearchesCount' => $adminAcceptedResearchesCount,
                'superPublishedResearchesCount' => $superPublishedResearchesCount,
                'superAcceptedResearchesCount' => $superAcceptedResearchesCount,
            ]);

        });

    }

}

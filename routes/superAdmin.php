<?php

use App\Http\Controllers\Admin\SpecializationTypeController;
use App\Http\Controllers\SuperAdmin\Auth\UserController;
use App\Http\Controllers\SuperAdmin\PaymentController as SuperAdminPaymentController;
use App\Http\Controllers\SuperAdmin\ResearchController as SuperAdminResearchController;
use App\Http\Controllers\SuperAdmin\DepartmentController;
use App\Http\Controllers\SuperAdmin\ManageNotificationController;
use App\Http\Controllers\SuperAdmin\PostGraduationController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\SuperAdmin\StudentReports;
use App\Http\Controllers\SuperAdmin\SuperAdminStudentController;

use Illuminate\Support\Facades\Route;

// ---> Super Admin Routes
Route::middleware(['permission:manage-admins'])->prefix('admin')->name('admins.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/register', [UserController::class, 'create'])->name('create');
    Route::post('/register', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::middleware(['permission:send-notifications'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [ManageNotificationController::class, 'index'])->name('index');
});

Route::middleware(['permission:manage-departments'])->prefix('super/departments')->name('departments.')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/refresh', [DepartmentController::class, 'refresh'])->name('refresh');
    Route::post('/', [DepartmentController::class, 'store'])->name('store');
    Route::get('{id}/show', [DepartmentController::class, 'show'])->name('show');
    Route::put('{id}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('{id}', [DepartmentController::class, 'destroy'])->name('destroy');
    Route::get('/{department}/{status}', [DepartmentController::class, 'status'])->name('status');
});

// --> Sspecialization Type
Route::prefix('super/specializations')->name('specializations.')->group(function () {
    Route::get('/', [SpecializationTypeController::class, 'index'])->name('index');
    Route::get('/refresh', [SpecializationTypeController::class, 'refresh'])->name('refresh');
    Route::post('/', [SpecializationTypeController::class, 'store'])->name('store');
    Route::get('{id}/show', [SpecializationTypeController::class, 'show'])->name('show');
    Route::put('{id}', [SpecializationTypeController::class, 'update'])->name('update');
    Route::delete('{id}', [SpecializationTypeController::class, 'destroy'])->name('destroy');
});

Route::middleware(['permission:generate-reports'])->prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [StudentReports::class, 'index'])->name('index');
});

Route::middleware(['permission:view-all-data'])->group(function () {

    // --> view students Details
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/super', [SuperAdminStudentController::class, 'index'])->name('index');
        Route::get('/super/{student}', [SuperAdminStudentController::class, 'show'])->name('show');
    });


    Route::name('post-graduation.')->group(function () {
        Route::get('post-graduation/super', [PostGraduationController::class, 'index'])->name('index');
        Route::get('post-graduation/super/{post_graduation}', [PostGraduationController::class, 'show'])->name('show');
    });

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/super', [SuperAdminPaymentController::class, 'index'])->name('index');
        Route::get('/super/{postGraduation}', [SuperAdminPaymentController::class, 'show'])->name('show');
    });

    Route::prefix('researches/super')->name('researches.')->group(function () {
        Route::get('/', [SuperAdminResearchController::class, 'index'])->name('index');
        Route::get('/{post_graduation}', [SuperAdminResearchController::class, 'show'])->name('show');
        Route::get('/status/{status}', [SuperAdminResearchController::class, 'status'])->name('status');
    });

});


Route::prefix('super/settings')->name('settings.')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
});

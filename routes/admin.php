<?php


use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\PostGraduationStepController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ResearchController as AdminResearchController;
use App\Http\Controllers\SendStudentEmailController;
use Illuminate\Support\Facades\Route;

// ---> Admin Routes

// check.department = middleware
Route::middleware(['permission:manage-students'])->group(function () {

    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('/{department}/{status}', [AdminDepartmentController::class, 'status'])->name('status');
    });

    // --> Manage Student
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/{student}', [StudentController::class, 'show'])->name('show');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });

    // --> Manage Post Graduation Steps
    Route::resource('post-graduation', PostGraduationStepController::class)->except(['create']);

    // --> Manage Post Graduation Steps
    Route::resource('researches', AdminResearchController::class)->except('store');
    Route::get('researches/status/{status}', [AdminResearchController::class, 'status'])->name('researches.status');

    // --> Manage Payments
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [AdminPaymentController::class, 'index'])->name('index');
        Route::get('/{post_graduation}', [AdminPaymentController::class, 'show'])->name('show');
        Route::delete('/{post_graduation}', [AdminPaymentController::class, 'destroy'])->name('destroy');
        Route::post('/store', [AdminPaymentController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:send-emails'])->prefix('send-emails')->name('send-emails.')->group(function () {
        Route::get('/', [SendStudentEmailController::class, 'index'])->name('index');
    });
});


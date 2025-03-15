<?php


use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', [LayoutController::class, 'index'])->name('home');

// Change Language
Route::get('/lang/{locale}', function ($locale, Request $request) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale); // تخزين اللغة في الجلسة
        App::setLocale($locale); // تعيين اللغة للتطبيق
    }
    return redirect()->back();
})->name('lang.switch');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/panel', action: function () {
        return view('panel.panel');
    })->name('panel');

});




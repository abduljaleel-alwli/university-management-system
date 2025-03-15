<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // dd(App::getLocale());
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale')); // تعيين اللغة من الجلسة
        }
        return $next($request);
    }
}

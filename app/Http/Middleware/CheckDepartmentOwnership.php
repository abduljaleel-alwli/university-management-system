<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDepartmentOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $departmentId = $request->route('department'); // جلب معرف القسم من الرابط

        // تحقق مما إذا كان المستخدم لديه دور Admin أو Super Admin أو ينتمي إلى القسم
        if ($user->hasRole(['admin']) || $user->department_id == $departmentId) {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}

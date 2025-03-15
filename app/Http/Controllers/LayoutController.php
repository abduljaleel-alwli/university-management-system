<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect('/panel');
        }
        return view('panel.auth.login');
    }
}

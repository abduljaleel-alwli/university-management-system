<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendStudentEmailController extends Controller
{
    public function index(){
        return view('panel.admin.email.index');
    }
}

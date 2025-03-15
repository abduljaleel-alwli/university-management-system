<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendStudentEmailController extends Controller
{
    public function index(){
        return view('panel.admin.email.index');
    }
}

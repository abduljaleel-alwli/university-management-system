<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentReports extends Controller
{
    public function index(){
        return view('panel.super-admin.report.index');
    }
}

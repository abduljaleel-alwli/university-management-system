<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageNotificationController extends Controller
{
    public function index() {
        return view('panel.super-admin.notification.manage-notification');
    }
}

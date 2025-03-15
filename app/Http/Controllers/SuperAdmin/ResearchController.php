<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Researches;

class ResearchController extends Controller
{
    public function index()
    {
        // تصفية الأبحاث بناءً على القسم
        $researches = Researches::with(['student', 'department', 'author', 'editor'])->paginate(15);

        return view('panel.super-admin.research.index', compact('researches'));
    }

    public function show($id)
    {
        return view('panel.super-admin.research.show', [
         'research_id' => $id
        ]);
    }

    // --> Get Research with Status
    public function status($status){

        $researches = Researches::where('status', $status)->paginate(15);
        return view('panel.admin.research.status', [
            'researches' => $researches,
            'status' => $status
        ]);
    }

}

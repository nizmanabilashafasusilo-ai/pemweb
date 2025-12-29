<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivity;

class AdminActivityController extends Controller
{
    public function index()
    {
        $logs = AdminActivity::with('user')->orderBy('created_at','desc')->paginate(50);
        return view('admin.activity.index', compact('logs'));
    }
}

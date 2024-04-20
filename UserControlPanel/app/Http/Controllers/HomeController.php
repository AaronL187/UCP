<?php

namespace App\Http\Controllers;

use App\Models\SerialChange;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin_view()
    {
        return view('admin.newsidebar');
    }
    public function serialManage()
    {
        $serialChanges = SerialChange::all();
        return view('admin.serial.manage', compact('serialChanges'));
    }
}

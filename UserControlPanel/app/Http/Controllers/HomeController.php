<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin_view()
    {
        return view('admin.newsidebar');
    }
}

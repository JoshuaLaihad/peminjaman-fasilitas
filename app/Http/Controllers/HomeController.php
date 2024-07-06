<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        // Logika untuk tampilan dashboard admin
        return view('admin.dashboard');
    }

    public function userDashboard()
    {
        // Logika untuk tampilan dashboard user
        return view('user.dashboard');
    }
}

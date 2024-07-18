<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin')->only('adminDashboard');
        $this->middleware('checkrole:user')->only('userDashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function userDashboard()
    {
        return view('user.dashboard');
    }
}

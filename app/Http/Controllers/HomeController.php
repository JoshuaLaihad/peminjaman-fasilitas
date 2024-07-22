<?php
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $title = "Dashboard Admin";
        $users = User::all();
        $usersCount = $users->count();

        $categories = Category::all();
        $categoriesCount = $categories->count();

        $facilitiesIn = Facility::where('status', 'tersedia')->get();
        $facilitiesInCount = $facilitiesIn->count();

        $facilitiesOut = Facility::where('status', 'dipinjam')->get();
        $facilitiesOutCount = $facilitiesOut->count();

        $borrowings = Borrowing::where('status', 'pending');
        $borrowingsCount = $borrowings->count();  
        
        $reports = Borrowing::whereIn('status', ['diterima', 'ditolak', 'selesai'])->get();
        $reportsCount = $reports->count();

        return view('admin.dashboard', compact(
            'title',
            'usersCount', 
            'categoriesCount', 
            'facilitiesInCount', 
            'facilitiesOutCount', 
            'borrowingsCount', 
            'reportsCount'
        ));
    }

public function userDashboard()
{
    $title = "Dashboard User";

    $facilitiesIn = Facility::where('status', 'tersedia');
    $facilitiesInCount = $facilitiesIn->count();
    
    $facilitiesOut = Facility::where('status', 'dipinjam');
    $facilitiesOutCount = $facilitiesOut->count();
    
    $borrowings = Borrowing::with(['user'])
        ->where('status', 'pending')
        ->where('user_id', Auth::id())
        ->get();
    $borrowingsCount = $borrowings->count();
    
    $reports = Borrowing::with(['user'])
        ->whereIn('status', ['diterima', 'ditolak', 'selesai'])
        ->where('user_id', Auth::id())
        ->get();
    $reportsCount = $reports->count();

    return view('user.dashboard', compact(
        'title',
        'facilitiesInCount', 
        'facilitiesOutCount', 
        'borrowingsCount', 
        'reportsCount'
    ));
}


    
}

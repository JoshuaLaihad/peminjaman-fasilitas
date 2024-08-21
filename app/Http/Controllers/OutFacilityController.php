<?php 
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;

class OutFacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin')->except(['FasilitasKeluarUser']);
        $this->middleware('checkrole:user')->only(['FasilitasKeluarUser']);
    }

    public function FasilitasKeluar()
    {
        $title = "Laporan Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user'])
        ->where('status', '=', 'Diterima')
        ->get();
        $facilities = Facility::with('category')
        ->where('status', '=', 'Dipinjam')
        ->get();
        //dd($facilities);
        return view('admin.fasilitaskeluar', compact('title', 'borrowings', 'facilities'));
    }

    public function FasilitasKeluarUser()
    {
        $title = "Laporan Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user'])
        ->where('status', '=', 'Diterima')
        ->get();
        $facilities = Facility::with('category')
        ->where('status', '=', 'Dipinjam')
        ->get();
        //dd($facilities);
        return view('user.fasilitaskeluar', compact('title', 'borrowings', 'facilities'));
    }
}

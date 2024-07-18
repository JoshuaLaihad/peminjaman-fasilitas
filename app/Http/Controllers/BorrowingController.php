<?php
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin')->only(['PeminjamanAdmin', 'storeAdmin', 'updateAdmin', 'destroyAdmin']);
        $this->middleware('checkrole:user')->only(['PeminjamanUser', 'storeUser', 'updateUser', 'destroyUser']);
    }

    // Display a listing of the resource for admin.
    public function PeminjamanAdmin()
    {
        $borrowings = Borrowing::with(['facility', 'user'])->get();
        $facilities = Facility::with('category')->get();
        $categories = $facilities->pluck('category')->unique('id');

        return view('admin.peminjaman', compact('borrowings', 'categories', 'facilities'));
    }

    // Display a listing of the resource for user.
    public function PeminjamanUser()
    {
        $borrowings = Borrowing::with(['facility', 'user'])
            ->where('user_id', Auth::id())
            ->get();
        $facilities = Facility::with('category')->get();
        $categories = $facilities->pluck('category')->unique('id');

        return view('user.peminjaman', compact('borrowings', 'categories', 'facilities'));
    }

    // Store a newly created resource in storage for admin.
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'tanggal_dari' => 'required|date',
            'tanggal_sampai' => 'required|date|after:tanggal_dari',
            'facility_id' => 'required|exists:facilities,id',
            'jumlah_dipinjam' => 'required|integer',
        ]);

        $facility = Facility::findOrFail($request->facility_id);

        if ($facility->jumlah < $request->jumlah_dipinjam) {
            return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk peminjaman.');
        }

        Borrowing::create([
            'fasilitas_id' => $facility->id,
            'user_id' => Auth::id(),
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'jumlah_dipinjam' => $request->jumlah_dipinjam,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil.');
    }

    // Store a newly created resource in storage for user.
    public function storeUser(Request $request)
    {
        $request->validate([
            'tanggal_dari' => 'required|date',
            'tanggal_sampai' => 'required|date|after:tanggal_dari',
            'facility_id' => 'required|exists:facilities,id',
            'jumlah_dipinjam' => 'required|integer',
        ]);

        $facility = Facility::findOrFail($request->facility_id);

        if ($facility->jumlah < $request->jumlah_dipinjam) {
            return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk peminjaman.');
        }

        Borrowing::create([
            'fasilitas_id' => $facility->id,
            'user_id' => Auth::id(),
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'jumlah_dipinjam' => $request->jumlah_dipinjam,
            'status' => 'pending',
        ]);

        return redirect()->route('user.peminjaman')->with('success', 'Peminjaman berhasil.');
    }
}

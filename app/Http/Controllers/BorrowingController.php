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
        $this->middleware('checkrole:admin')->only(['PeminjamanAdmin', 'storeAdmin']);
        $this->middleware('checkrole:user')->only(['PeminjamanUser', 'storeUser']);
    }

    // Display a listing of the resource for admin.
    public function PeminjamanAdmin()
    {
        $title = "Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user'])->get();
        $facilities = Facility::with('category')
        ->where('status', '=', 'Tersedia')
        ->get();
        $categories = $facilities->pluck('category')->unique('id_category');
        return view('admin.peminjaman', compact('title', 'borrowings', 'categories', 'facilities'));
    }

    // Display a listing of the resource for user.
    public function PeminjamanUser()
    {
        $title = "Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user']) ->get();
        $facilities = Facility::with('category')
        ->where('status', '=', 'Tersedia')
        ->get();
        $categories = $facilities->pluck('category')->unique('id_category');

        return view('user.peminjaman', compact('title', 'borrowings', 'categories', 'facilities'));
    }

    // Store a newly created resource in storage for admin.
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'tanggal_dari' => 'required|date',
            'tanggal_sampai' => 'required|date|after:tanggal_dari',
            'jumlah_dipinjam' => 'required|integer',
            'nama_surat' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tujuan_peminjaman' => 'required|string|max:255',
        ]);
        
       

        $facility = Facility::findOrFail($request->id_facility);

        if ($facility->jumlah < $request->jumlah_dipinjam) {
            return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk peminjaman.');
        }

        if ($request->hasFile('nama_surat')) {
            $file = $request->file('nama_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('uploads'), $filename);
            
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal meng-upload file.');
            }
            
        } else {
            return redirect()->back()->with('error', 'File surat peminjaman tidak ditemukan.');
        }

        Borrowing::create([
            'id_facility' => $facility->id_facility,
            'id_user' => Auth::user()->id_user,  // Gantilah dengan id_user
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'jumlah_dipinjam' => $request->jumlah_dipinjam,
            'status' => 'pending',
            'nama_surat' => $filename,
            'tujuan_peminjaman' => $request->tujuan_peminjaman,
        ]);

        return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil.');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'tanggal_dari' => 'required|date',
            'tanggal_sampai' => 'required|date|after:tanggal_dari',
            'jumlah_dipinjam' => 'required|integer',
            'nama_surat' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tujuan_peminjaman' => 'required|string|max:255',
        ]);
        
       

        $facility = Facility::findOrFail($request->id_facility);

        if ($facility->jumlah < $request->jumlah_dipinjam) {
            return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk peminjaman.');
        }

        if ($request->hasFile('nama_surat')) {
            $file = $request->file('nama_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('uploads'), $filename);
            
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal meng-upload file.');
            }
            
        } else {
            return redirect()->back()->with('error', 'File surat peminjaman tidak ditemukan.');
        }

        Borrowing::create([
            'id_facility' => $facility->id_facility,
            'id_user' => Auth::user()->id_user,  // Gantilah dengan id_user
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'jumlah_dipinjam' => $request->jumlah_dipinjam,
            'status' => 'pending',
            'nama_surat' => $filename,
            'tujuan_peminjaman' => $request->tujuan_peminjaman,
        ]);

        return redirect()->route('user.peminjaman')->with('success', 'Peminjaman berhasil.');
    }


}

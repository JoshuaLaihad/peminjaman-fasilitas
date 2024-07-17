<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    // Display a listing of the resource.
    public function Peminjaman()
    {
        $borrowings = Borrowing::with(['facility', 'user'])
            ->when(!Auth::user()->is_admin, function($query) {
                return $query->where('user_id', Auth::id());
            })
            ->get();

        $facilities = Facility::with('category')->get();
        $categories = $facilities->pluck('category')->unique('id');

        if (Auth::user()->is_admin) {
            return view('admin.peminjaman', compact('borrowings', 'categories', 'facilities'));
        } else {
            return view('user.peminjaman', compact('borrowings', 'categories', 'facilities'));
        }

    }

    public function Laporan()
    {
        if (Auth::user()->is_admin) {
            $borrowings = Borrowing::with(['facility', 'user'])->get();
            $facilities = Facility::with('category')->get();
            return view('admin.laporan', compact('borrowings', 'facilities'));
        } else {
            $borrowings = Borrowing::with(['facility', 'user'])
                ->where('user_id', Auth::id())
                ->get();
            $facilities = Facility::with('category')->get(); // Ensure this is defined here too
        }
    }


    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_dari' => 'required|date',
            'tanggal_sampai' => 'required|date|after:tanggal_dari',
            'facility_id' => 'required|exists:facilities,id', // Ensure the facility ID is valid
            'jumlah_dipinjam' => 'required|integer',
            // 'status' => 'required|in:pending,ditolak,diterima', // Ensure the status is one of the allowed values    
        ]);

        // Asumsikan bahwa facility_id adalah ID, bukan nama
        $facility = Facility::findOrFail($request->facility_id);

        if ($facility->jumlah < $request->jumlah) {
            return redirect()->back()->with('error', 'jumlah tidak mencukupi untuk peminjaman.');
        }
        
        // $facility->jumlah -= $request->jumlah;
        // $facility->save();

        // $newFacility = $facility->replicate();
        // $newFacility->jumlah = $request->jumlah;
        // $newFacility->status = 'Dipinjam';
        // $newFacility->save();

        Borrowing::create([
            'fasilitas_id' => $facility->id,
            'user_id' => Auth::id(),
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'jumlah_dipinjam' => $request->jumlah_dipinjam,
            'status' => $request->status,
            
        ]);

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil.');
        } else {
            return redirect()->route('user.peminjaman')->with('success', 'Peminjaman berhasil.');
        }
    }




    // Update the specified resource in storage.
    

    // Remove the specified resource from storage.

}
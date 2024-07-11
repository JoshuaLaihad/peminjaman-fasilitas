<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    // Display a listing of the resource.
    public function Peminjaman()
    {
        if (Auth::user()->is_admin) {
            // For admin
            $borrowings = Borrowing::with(['facility', 'user'])->get();
            $facilities = Facility::with('category')->get();
            return view('admin.peminjaman', compact('borrowings', 'facilities'));
        } else {
            // For regular user
            $borrowings = Borrowing::with(['facility', 'user'])
                ->where('user_id', Auth::id())
                ->get();
            $facilities = Facility::with('category')->get();
            return view('user.peminjaman', compact('borrowings', 'facilities'));
        }
        
    }

    public function Laporan()
    {
        if (Auth::user()->is_admin) {
            $borrowings = Borrowing::with(['facility', 'user'])->get();
            $facilities = Facility::with('category')->get();
        } else {
            $borrowings = Borrowing::with(['facility', 'user'])
                ->where('user_id', Auth::id())
                ->get();
            $facilities = Facility::with('category')->get(); // Ensure this is defined here too
        }
        
        return view('admin.laporan', compact('borrowings', 'facilities'));
    }


    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id', // Sesuaikan dengan nama input di form
            'tanggal_mulai' => 'required|date', // Sesuaikan dengan nama input di form
            'tanggal_sampai' => 'required|date|after:tanggal_mulai', // Sesuaikan dengan nama input di form
        ]);

        Borrowing::create([
            'fasilitas_id' => $request->facility_id, // Sesuaikan dengan nama input di form
            'user_id' => Auth::id(), // Mendapatkan ID pengguna yang sedang login
            'tanggal_dari' => $request->tanggal_mulai, // Sesuaikan dengan nama input di form
            'tanggal_sampai' => $request->tanggal_sampai, // Sesuaikan dengan nama input di form
        ]);

        if (Auth::user()->is_admin) {
            // Redirect ke view admin.peminjaman
            return redirect()->route('admin.peminjaman')->with('success', 'Borrowing status updated successfully.');
        } else {
            // Redirect ke view user.peminjaman
            return redirect()->route('user.peminjaman')->with('success', 'Borrowing status updated successfully.');
        }
    }


    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'status' => 'required|in:pending,ditolak,diterima', // Validasi status
        ]);

        // Temukan peminjaman berdasarkan ID
        $borrowing = Borrowing::findOrFail($id);

        // Perbarui data borrowing
        $borrowing->update([
            'status' => $request->status,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.laporan')->with('success', 'Borrowing status updated successfully.');
}

    // Remove the specified resource from storage.
    public function destroy(Borrowing $borrowing)
    {
        if (Auth::user()->is_admin || $borrowing->user_id == Auth::id()) {
            $borrowing->delete();
            return redirect()->route('borrowings.index')->with('success', 'Borrowing deleted successfully.');
        }

        return redirect()->route('borrowings.index')->with('error', 'Unauthorized access.');
    }
}

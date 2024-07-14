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
            'name' => 'required|string|max:255',
            'asal_instansi' => 'required|string|max:255',
            'no_handphone' => 'required|string|max:15',
            'facility_id' => 'required|exists:facilities,id', // Sesuaikan dengan nama input di form
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_dari' => 'required|date', // Sesuaikan dengan nama input di form
            'tanggal_sampai' => 'required|date|after:tanggal_dari', // Sesuaikan dengan nama input di form
        ]);

         // Kurangi stok dari aset yang dipilih
         $facility = Facility::findOrFail($request->facility_id);

         // Pastikan stok cukup untuk dipinjam
         // Pastikan stok cukup untuk dipinjam
        if ($facility->stok < $request->stok) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk peminjaman.');
        }

        // Kurangi stok pada data fasilitas yang lama
        $facility->stok -= $request->stok;
        $facility->save();

        // Buat peminjaman baru
        Borrowing::create([
            'facility_id' => $request->facility_id,
            'user_id' => Auth::id(),
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
        ]);

        // Buat duplikasi data fasilitas dengan stok yang dikurangi dan status 'Dipinjam'
        $newFacility = $facility->replicate();
        $newFacility->stok = $request->stok;
        $newFacility->status = 'Dipinjam';
        $newFacility->save();

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

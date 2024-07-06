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
        if (Auth::user()->is_admin) {
            // Admin can see all borrowings
            $borrowings = Borrowing::with(['facilities', 'users'])->get();
        } else {
            // User can only see their own borrowings
            $borrowings = Borrowing::with(['facilities', 'users'])
                ->where('user_id', Auth::id())
                ->get();
        }

        $borrowings = Borrowing::with(['facilities', 'users'])->get();
        return view('user.peminjaman', compact('borrowings'));
    }

    public function adminPeminjaman()
    {
        $borrowings = Borrowing::with(['facilities', 'users'])->get();
        return view('admin.peminjaman', compact('borrowings'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        if(Auth::user()->is_admin){
            $request->validate([
                'fasilitas_id' => 'required|exists:facilities,id',
                'user_id' => 'required|exists:users,id',
                'tanggal_dari' => 'required|date',
                'tanggal_sampai' => 'required|date|after:tanggal_dari',
                'status' => 'required|in:diterima,ditolak,pending',
            ]);
    
            Borrowing::create([
                'fasilitas_id' => $request->fasilitas_id,
                'user_id' => $request->user_id,
                'tanggal_dari' => $request->tanggal_dari,
                'tanggal_sampai' => $request->tanggal_sampai,
                'status' => $request->status,
            ]);
        }else{
            $request->validate([
                'fasilitas_id' => 'required|exists:facilities,id',
                'tanggal_dari' => 'required|date',
                'tanggal_sampai' => 'required|date|after:tanggal_dari',
            ]);
    
            Borrowing::create([
                'fasilitas_id' => $request->fasilitas_id,
                'user_id' => Auth::id(),
                'tanggal_dari' => $request->tanggal_dari,
                'tanggal_sampai' => $request->tanggal_sampai,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('admin.borrowing')->with('success', 'Borrowing created successfully.');
    }

    // Display the specified resource.
    public function show(Borrowing $borrowing)
    {
        if (Auth::user()->is_admin || $borrowing->user_id == Auth::id()) {
            return view('borrowings.show', compact('borrowing'));
        }

        return redirect()->route('borrowings.index')->with('error', 'Unauthorized access.');
    }

    // Show the form for editing the specified resource.
    public function edit(Borrowing $borrowing)
    {
        if (Auth::user()->is_admin || $borrowing->user_id == Auth::id()) {
            $facilities = Facility::all();
            return view('borrowings.edit', compact('borrowing', 'facilities'));
        }

        return redirect()->route('borrowings.index')->with('error', 'Unauthorized access.');
    }

    // Update the specified resource in storage.
    public function update(Request $request, Borrowing $borrowing)
    {
        if (Auth::user()->is_admin || $borrowing->user_id == Auth::id()) {
            $request->validate([
                'fasilitas_id' => 'required|exists:facilities,id',
                'tanggal_dari' => 'required|date',
                'tanggal_sampai' => 'required|date|after:tanggal_dari',
                'status' => 'required|string',
            ]);

            $borrowing->update($request->all());

            return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully.');
        }

        return redirect()->route('borrowings.index')->with('error', 'Unauthorized access.');
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

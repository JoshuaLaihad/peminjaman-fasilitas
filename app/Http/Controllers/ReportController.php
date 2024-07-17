<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminLaporan()
    {
        $borrowings = Borrowing::with(['facility', 'user'])->get();
        $facilities = Facility::with('category')->get();
        return view('admin.laporan', compact('borrowings', 'facilities'));
    }

    public function userLaporan(){
        $borrowings = Borrowing::with(['facility', 'user'])
        ->where('user_id', Auth::id())
        ->get();
        $facilities = Facility::with('category')->get(); // Ensure this is defined here too
        return view('user.laporan', compact('borrowings', 'facilities'));
    }

    // public function approveBorrowing($id)
    // {
    //     $borrowing = Borrowing::findOrFail($id);

    //     // Pastikan hanya admin yang bisa melakukan operasi ini
    //     if (!Auth::user()->is_admin) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     // Ubah status menjadi "diterima"
    //     $borrowing->status = 'diterima';
    //     $borrowing->save();

    //     return redirect()->route('admin.laporan')->with('success', 'Status peminjaman berhasil diubah menjadi diterima.');
    // }
    public function store(Request $request)
    {
        // Implementasi untuk menyimpan data baru
    }

    // Method untuk mengupdate data
    public function update(Request $request, $id)
    {
    // Validasi data
    $request->validate([
        'status' => 'required|in:pending,ditolak,diterima', // Validasi status
    ]);

    // Temukan peminjaman berdasarkan ID
    $borrowing = Borrowing::findOrFail($id);

    // Hanya kurangi jumlah jika status diubah menjadi diterima dan status sebelumnya bukan diterima
    if ($borrowing->status !== 'diterima' && $request->status === 'diterima') {
        $facility = Facility::findOrFail($borrowing->fasilitas_id);
        
        if ($facility->jumlah < $borrowing->jumlah_dipinjam) {
            return redirect()->back()->with('error', 'jumlah tidak mencukupi untuk peminjaman.');
        }

        // Kurangi jumlah fasilitas
        $facility->jumlah -= $borrowing->jumlah_dipinjam;
        $facility->save();

        // Perbarui status fasilitas menjadi "Dipinjam"
        $newFacility = $facility->replicate();
        $newFacility->jumlah = $borrowing->jumlah_dipinjam;
        $newFacility->created_at = now(); // Menambahkan created_at
        $newFacility->status = 'Dipinjam';
        $newFacility->save();

        // Simpan created_at dari fasilitas yang direplikasi pada borrowing
        $borrowing->replicated_created_at = $newFacility->created_at;
        $borrowing->save();

    } elseif ($borrowing->status === 'diterima' && $request->status !== 'diterima') {
        // Jika status sebelumnya diterima dan sekarang diubah menjadi selain diterima, kembalikan jumlah fasilitas
        $facility = Facility::findOrFail($borrowing->fasilitas_id);
        $facility->jumlah += $borrowing->jumlah_dipinjam;
        $facility->status = 'Tersedia'; // Ubah status fasilitas menjadi Tersedia
        $facility->save();

        // Hapus fasilitas yang direplikasi dengan status "Dipinjam"
        $replicatedFacility = Facility::where('status', 'Dipinjam')
            ->where('jumlah', $borrowing->jumlah_dipinjam)
            ->where('created_at', $borrowing->replicated_created_at)
            ->first();

        if ($replicatedFacility) {
            $replicatedFacility->delete();
        }
    }

    // Perbarui data borrowing
    $borrowing->update([
        'status' => $request->status,
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.laporan')->with('success', 'Status peminjaman berhasil diperbarui.');
    }



    // Method untuk menghapus data
    public function destroy($id)
    {
            $borrowing = Borrowing::find($id);
            $borrowing->delete();
            return redirect()->route('admin.laporan')->with('success', 'Borrowing deleted successfully.');
    }
}

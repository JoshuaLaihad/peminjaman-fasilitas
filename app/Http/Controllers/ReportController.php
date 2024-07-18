<?php 
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin')->only(['adminLaporan', 'update', 'destroy']);
        $this->middleware('checkrole:user')->only('userLaporan');
    }

    public function adminLaporan()
    {
        $borrowings = Borrowing::with(['facility', 'user'])->get();
        $facilities = Facility::with('category')->get();
        return view('admin.laporan', compact('borrowings', 'facilities'));
    }

    public function userLaporan()
    {
        $borrowings = Borrowing::with(['facility', 'user'])
            ->where('user_id', Auth::id())
            ->get();
        $facilities = Facility::with('category')->get();
        return view('user.laporan', compact('borrowings', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,ditolak,diterima,selesai',
        ]);

        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'diterima' && $request->status === 'diterima') {
            $facility = Facility::findOrFail($borrowing->fasilitas_id);

            if ($facility->jumlah < $borrowing->jumlah_dipinjam) {
                return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk peminjaman.');
            }

            $facility->jumlah -= $borrowing->jumlah_dipinjam;
            $facility->save();

            $newFacility = $facility->replicate();
            $newFacility->jumlah = $borrowing->jumlah_dipinjam;
            $newFacility->created_at = now();
            $newFacility->status = 'Dipinjam';
            $newFacility->save();

            $borrowing->replicated_created_at = $newFacility->created_at;
            $borrowing->save();
        } elseif ($borrowing->status === 'diterima' && $request->status !== 'diterima') {
            $facility = Facility::findOrFail($borrowing->fasilitas_id);
            $facility->jumlah += $borrowing->jumlah_dipinjam;
            $facility->status = 'Tersedia';
            $facility->save();

            $replicatedFacility = Facility::where('status', 'Dipinjam')
                ->where('jumlah', $borrowing->jumlah_dipinjam)
                ->where('created_at', $borrowing->replicated_created_at)
                ->first();

            if ($replicatedFacility) {
                $replicatedFacility->delete();
            }
        }

        $borrowing->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.laporan')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::find($id);
        $borrowing->delete();
        return redirect()->route('admin.laporan')->with('success', 'Borrowing deleted successfully.');
    }
}

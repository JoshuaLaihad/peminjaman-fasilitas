<?php 
namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $title = "Laporan Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user'])->get();
        $facilities = Facility::with('category')->get();
        return view('admin.laporan', compact('title', 'borrowings', 'facilities'));
    }

    public function userLaporan()
    {
        $title = "Laporan Peminjaman";
        $borrowings = Borrowing::with(['facility', 'user'])
            ->where('user_id', Auth::id())
            ->get();
        $facilities = Facility::with('category')->get();
        return view('user.laporan', compact('title', 'borrowings', 'facilities'));
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

            $telegramBotToken = '7123319279:AAF9JVRobFnch6bEfYibdkDr8U95lPn7_fk';
            $chatId = $borrowing->user->chat_id;
            $message = "Selamat peminjaman fasilitas Anda telah diterima! Berikut detail fasilitas Anda:\n" .
                       "Kategori Fasilitas = {$borrowing->facility->category->kategori_fasilitas}\n" .
                       "Nama Fasilitas = {$borrowing->facility->nama_fasilitas}\n" .
                       "Keterangan Fasilitas = {$borrowing->keterangan_fasilitas}" .
                       "Jumlah Dipinjam = {$borrowing->jumlah_dipinjam}\n" .
                       "Tanggal Pinjam = {$borrowing->tanggal_dari}\n" .
                       "Tanggal Kembali = {$borrowing->tanggal_sampai}" ;

            $response = Http::post("https://api.telegram.org/bot{$telegramBotToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
            ]);

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
        return redirect()->route('admin.laporan')->with('success', 'Laporan Peminjaman Berhasil Dihapus.');
    }
}

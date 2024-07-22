<?php 
namespace App\Http\Controllers;

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
        $title = "Data Fasilitas Keluar";
        $categories = Category::all();
        $facilities = Facility::with('category')->get();
        return view('admin.fasilitaskeluar', compact('title', 'categories', 'facilities'));
    }

    public function FasilitasKeluarUser()
    {
        $title = "Data Fasilitas Keluar User";
        $categories = Category::all();
        $facilities = Facility::with('category')->get();
        return view('user.fasilitaskeluar', compact('title', 'categories', 'facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'nama_fasilitas' => 'required|string|max:255',
            'keterangan_fasilitas' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'nama_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('public/uploads'), $filename);
        }

        Facility::create([
            'categories_id' => $request->categories_id,
            'nama_fasilitas' => $request->nama_fasilitas,
            'keterangan_fasilitas' => $request->keterangan_fasilitas,
            'status' => $request->status,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'nama_file' => $filename,
        ]);

        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'nama_fasilitas' => 'required|string|max:255',
            'keterangan_fasilitas' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'nama_file' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $facility = Facility::findOrFail($id);

        if ($request->hasFile('nama_file')) {
            if ($facility->nama_file && file_exists(public_path('public/uploads/' . $facility->nama_file))) {
                unlink(public_path('public/uploads/' . $facility->nama_file));
            }

            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('public/uploads'), $filename);

            $validatedData['nama_file'] = $filename;
        } else {
            $validatedData['nama_file'] = $facility->nama_file;
        }

        if (in_array($validatedData['status'], ['dipinjam', 'rusak'])) {
            $jumlah_keluar = $request->input('jumlah_keluar', 0);
            if ($jumlah_keluar > 0 && $jumlah_keluar <= $facility->jumlah) {
                $facility->jumlah -= $jumlah_keluar;
                $facility->save();
            }
        }

        $facility->update($validatedData);

        return redirect()->route('admin.fasilitaskeluar')->with('success', 'Data fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        return redirect()->route('admin.fasilitaskeluar')->with('success', 'Data berhasil dihapus');
    }
}

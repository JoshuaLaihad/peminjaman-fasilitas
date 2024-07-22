<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin')->except(['FasilitasUser']);
        $this->middleware('checkrole:user')->only(['FasilitasUser']);
    }

    public function Fasilitas()
    {
        $title = "Data Fasilitas";
        $facilities = Facility::with('category')->get();
        $categories = Category::all();
        return view('admin.fasilitas', compact('title', 'facilities', 'categories'));
    }

    public function FasilitasUser()
    {
        $title = "Data Fasilitas";
        $facilities = Facility::with('category')->get();
        $categories = Category::all();
        return view('user.fasilitas', compact('title', 'facilities', 'categories'));
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
            $file->move(public_path('uploads'), $filename);
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

        return redirect()->route('admin.fasilitas')->with('success', 'Data Fasilitas Berhasil Ditambahkan');
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
            if ($facility->nama_file && file_exists(public_path('uploads/' . $facility->nama_file))) {
                unlink(public_path('uploads/' . $facility->nama_file));
            }

            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $validatedData['nama_file'] = $filename;
        } else {
            $validatedData['nama_file'] = $facility->nama_file;
        }

        $isStatusChanged = $validatedData['status'] != $facility->status;
        $isJumlahChanged = $validatedData['jumlah'] != $facility->jumlah;
        $isTanggalChanged = $validatedData['tanggal'] != $facility->tanggal;

        if ($isStatusChanged && $isJumlahChanged && $isTanggalChanged) {
            $newDataFacility = $facility->replicate();
            $newDataFacility->status = $validatedData['status'];
            $newDataFacility->tanggal = $validatedData['tanggal'];
            $newDataFacility->jumlah = $validatedData['jumlah'];

            $newDataFacility->save();

            $facility->jumlah -= $validatedData['jumlah'];
            $facility->save();
        } else {
            $facility->update($validatedData);
        }

        return redirect()->route('admin.fasilitas')->with('success', 'Data Fasilitas Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        return redirect()->route('admin.fasilitas')->with('success', 'Data Fasilitas Berhasil Dihapus');
    }
}

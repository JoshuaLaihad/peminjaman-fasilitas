<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function Fasilitas()
    {
        $facilities = Facility::with('category')->get();
        $categories = Category::all(); // Ambil semua kategori
        return view('admin.fasilitas', compact('facilities', 'categories'));
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
        // $path = $file->storeAs('uploads', $filename);
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
            // Delete old file if exists
            if ($facility->nama_file && file_exists(public_path('public/uploads/' . $facility->nama_file))) {
                unlink(public_path('public/uploads/' . $facility->nama_file));
            }
    
            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('public/uploads'), $filename);
    
            $validatedData['nama_file'] = $filename;
        } else {
            $validatedData['nama_file'] = $facility->nama_file; // Retain the old file if no new file is uploaded
        }

        $isStatusChanged = $validatedData['status'] != $facility->status;
        $isjumlahChanged = $validatedData['jumlah'] != $facility->jumlah;
        $isTanggalChanged = $validatedData['tanggal'] != $facility->tanggal;

        if ($isStatusChanged && $isjumlahChanged && $isTanggalChanged) {
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

        return redirect()->route('admin.fasilitas')->with('success', 'Data fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil dihapus');
    }
}

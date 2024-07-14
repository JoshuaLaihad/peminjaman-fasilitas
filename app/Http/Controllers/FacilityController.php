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
        'merk' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'stok' => 'required|integer|min:0',
        'status' => 'required|string|max:255',
        'tanggal' => 'required|date',
    ]);
    
        Facility::create([
            'categories_id' => $request->categories_id,
            'nama_fasilitas' => $request->nama_fasilitas,
            'merk' => $request->merk,
            'model' => $request->model,
            'stok' => $request->stok,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'nama_fasilitas' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'stok' => 'required|integer',
            'status' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $facility = Facility::findOrFail($id);

        $isStatusChanged = $validatedData['status'] != $facility->status;
        $isStokChanged = $validatedData['stok'] != $facility->stok;
        $isTanggalChanged = $validatedData['tanggal'] != $facility->tanggal;

        if ($isStatusChanged && $isStokChanged && $isTanggalChanged) {
            $newDataFacility = $facility->replicate();
            $newDataFacility->status = $validatedData['status'];
            $newDataFacility->tanggal = $validatedData['tanggal'];
            $newDataFacility->stok = $validatedData['stok'];

            $newDataFacility->save();

            $facility->stok -= $validatedData['stok'];
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

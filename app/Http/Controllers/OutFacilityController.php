<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;

class OutFacilityController extends Controller
{
    public function FasilitasKeluar()
    {
        $categories = Category::all();
        $facilities = Facility::with('category')->get();
        return view('admin.fasilitaskeluar', compact('categories', 'facilities'));
       
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'categories_id' => 'required|exists:categories,id', // Validasi categories_id ada di tabel categories
            'nama_fasilitas' => 'required|string|max:255|unique:facilities,nama_fasilitas', // Pastikan unik di tabel facilities
            'merk' => 'required|string|max:255', // Validasi untuk merk
            'model' => 'required|string|max:255', // Validasi untuk model
            'stok' => 'required|integer|min:0', // Validasi untuk stok
            'status' => 'required|string|max:255', // Validasi untuk status
            'tanggal' => 'required|date', // Validasi untuk tanggal
        ]);

        // Buat fasilitas baru
        $facility = Facility::create([
            'categories_id' => $request->categories_id, // Sesuaikan dengan nama input di form
            'nama_fasilitas' => $request->nama_fasilitas, // Sesuaikan dengan nama input di form
            'merk' => $request->merk, // Sesuaikan dengan nama input di form
            'model' => $request->model, // Sesuaikan dengan nama input di form
            'stok' => $request->stok, // Sesuaikan dengan nama input di form
            'status' => $request->status, // Sesuaikan dengan nama input di form
            'tanggal' => $request->tanggal, // Sesuaikan dengan nama input di form
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'nama_fasilitas' => 'required|string|max:255|unique:facilities,nama_fasilitas,'.$id,
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'stok' => 'required|integer',
            'status' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Find the facility by ID
        $facility = Facility::findOrFail($id);

        if (in_array($validatedData['status'], ['dipinjam', 'rusak'])) {
            $jumlah_keluar = $request->input('jumlah_keluar', 0);
            if ($jumlah_keluar > 0 && $jumlah_keluar <= $facility->stok) {
                $facility->stok -= $jumlah_keluar;
                $facility->save();
    
                // Menambahkan data ke FacilityOutController
                $outFacilityController = new OutFacilityController();
                $outFacilityController->store([
                    'facility' => $facility->id,
                    'jumlah' => $jumlah_keluar,
                    'status' => $validatedData['status'],
                    'tanggal' => now(),
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.fasilitas')->with('success', 'Data fasilitas berhasil diperbarui');
    }
}

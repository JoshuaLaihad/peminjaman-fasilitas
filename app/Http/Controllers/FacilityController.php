<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function Fasilitas()
    {
        $categories = Category::all();
        $facilities = Facility::all();
        return view('admin.fasilitas', compact('categories', 'facilities'));
        
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'categories_id' => 'required|exists:categories,id', // Validate the categories_id exists in categories table
            'nama_fasilitas' => 'required|string|max:255|unique:facilities,nama_fasilitas', // Ensure it's unique in facilities table
        ]);
    
        // Create the facility
        $facility = Facility::create([
            'categories_id' => $request->categories_id, // Ensure this matches the input name
            'nama_fasilitas' => $request->nama_fasilitas, // Ensure this matches the input name
        ]);
    
        // Redirect with success message
        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
    
        $request->validate([
            'categories_id' => 'required|exists:categories,id', // Validate the categories_id exists in categories table
            'nama_fasilitas' => 'required|string|max:255', // Ensure it's unique in facilities table
        ]);

    $facilities = Facility::findOrFail($id);

    $fasilitas = [
        'categories_id' => $request->categories_id, // Ensure this matches the input name
        'nama_fasilitas' => $request->nama_fasilitas, // Ensure this matches the input name
    ];

    $facilities->update($fasilitas);

    return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        $facility->delete();
        return redirect()->route('admin.fasilitas')->with('success', 'Data berhasil dihapus');
    }
}

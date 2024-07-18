<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:admin');
    }

    public function Kategori()
    {
        $categories = Category::all();
        return view('admin.kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_fasilitas' => 'required|string|max:255',
        ]);

        Category::create([
            'kategori_fasilitas' => $request->kategori_fasilitas,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_fasilitas' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'kategori_fasilitas' => $request->kategori_fasilitas,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.kategori')->with('success', 'Category deleted successfully.');
    }
}

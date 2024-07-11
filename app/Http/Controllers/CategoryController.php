<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Kategori()
    {
        // Retrieve all categories
        
        $categories = Category::all();
        // Return the categories to a view (e.g., categories.index)
        return view('admin.kategori', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'kategori_fasilitas' => 'required|string|max:255',
        ]);

        // Create a new category
        Category::create([
            'kategori_fasilitas' => $request->kategori_fasilitas,
        ]);

        // Redirect to the categories index with a success message
        return redirect()->route('admin.kategori')->with('success', 'Category created successfully.');
    }
    public function update(Request $request, Category $category)
    {
        // Validate the request data
        $request->validate([
            'kategori_fasilitas' => 'required|string|max:255',
        ]);

        // Update the category
        $category->update($request->all());

        // Redirect to the categories index with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        // Redirect to the categories index with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

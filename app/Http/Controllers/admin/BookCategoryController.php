<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::paginate(10); // Adjust the number as needed
        return view('admin.bookCategoriesTable', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BookCategory::create($request->all());
        return redirect()->route('admin.bookCategoriesTable')->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = BookCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.bookCategoriesTable')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = BookCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.bookCategoriesTable')->with('success', 'Category deleted successfully.');
    }
}

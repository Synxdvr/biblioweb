<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller {
    public function index(Request $request) {
        $query = BookCategory::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('category_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        $categories = $query->paginate(10);
        return view('librarian.bookCategoriesTable', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BookCategory::create($request->all());
        return redirect()->route('librarian.bookCategoriesTable')->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = BookCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('librarian.bookCategoriesTable')->with('success', 'Category updated successfully.');
    }

    public function destroy($id) {
        $category = BookCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('librarian.bookCategoriesTable')->with('success', 'Category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('display_order')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'display_order' => 'required|integer|min:0',
        ]);

        Category::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'display_order' => $request->display_order,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'display_order' => 'required|integer|min:0',
        ]);

        $category->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'display_order' => $request->display_order,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->receiptDetails()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'This category cannot be deleted because it is already used in a receipt.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}

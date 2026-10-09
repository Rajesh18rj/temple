<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        // Display main categories with their subcategories
        $categories = Category::whereNull('parent_id')
            ->with('subcategories')
            ->orderBy('display_order')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Only main categories can be selected as parents
        $parentCategories = Category::whereNull('parent_id')
            ->orderBy('display_order')
            ->get();

        return view('categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('categories', 'id')
                    ->whereNull('parent_id'),
            ],
            'amount' => 'nullable|numeric|min:0',
            'display_order' => 'required|integer|min:0',
        ]);

        Category::create([
            'name' => $validated['name'],
            'parent_id' => $validated['parent_id'] ?? null,
            'amount' => $validated['amount'] ?? null,
            'display_order' => $validated['display_order'],
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Prevent selecting itself as its parent
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('display_order')
            ->get();

        return view('categories.edit', compact(
            'category',
            'parentCategories'
        ));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('categories', 'id')
                    ->whereNull('parent_id'),
                Rule::notIn([$category->id]),
            ],
            'amount' => 'nullable|numeric|min:0',
            'display_order' => 'required|integer|min:0',
        ]);

        // A category with subcategories cannot become a subcategory.
        if (
            $category->subcategories()->exists()
            && !empty($validated['parent_id'])
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'parent_id' => 'A main category with subcategories cannot become a subcategory.',
                ]);
        }

        $category->update([
            'name' => $validated['name'],
            'parent_id' => $validated['parent_id'] ?? null,
            'amount' => $validated['amount'] ?? null,
            'display_order' => $validated['display_order'],
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Prevent deleting a category that has subcategories.
        if ($category->subcategories()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'Please delete or move this category’s subcategories before deleting it.'
                );
        }

        // Preserve existing receipt details.
        if ($category->receiptDetails()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'This category cannot be deleted because it is already used in a receipt.'
                );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}

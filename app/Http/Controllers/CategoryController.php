<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return back()->with('status', 'Kategoria u shtua me sukses.');
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return back()->with('status', 'Kategoria u përditësua me sukses.');
    }

    public function destroy(Category $category)
    {
        if ($category->expenses()->exists()) {
            return back()->withErrors([
                'category' => 'Kjo kategori ka shpenzime dhe nuk mund të fshihet.',
            ]);
        }

        $category->delete();

        return back()->with('status', 'Kategoria u fshi me sukses.');
    }
}

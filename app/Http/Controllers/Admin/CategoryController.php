<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('back.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('back.pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
        ]);

        Category::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya əlavə edildi');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('back.pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya yeniləndi');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya silindi');
    }
}
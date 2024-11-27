<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->get();
        return view('back.pages.sub_category.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('back.pages.sub_category.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        SubCategory::create([
            'category_id' => $request->category_id,
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'slug' => Str::slug($request->name_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Alt kateqoriya uğurla əlavə edildi.');
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', 1)->get();
        return view('back.pages.sub_category.edit', compact('subCategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update([
            'category_id' => $request->category_id,
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'slug' => Str::slug($request->name_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Alt kateqoriya uğurla yeniləndi.');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Alt kateqoriya uğurla silindi.');
    }
}
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
        $sub_categories = SubCategory::with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('back.pages.sub_category.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name_az')
            ->get();
        
        return view('back.pages.sub_category.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $image = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = 'uploads/sub_categories/' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/sub_categories'), $image);
            }

            SubCategory::create([
                'category_id' => $request->category_id,
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'image' => $image,
                'image_alt_az' => $request->image_alt_az,
                'image_alt_en' => $request->image_alt_en,
                'image_alt_ru' => $request->image_alt_ru,
                'image_title_az' => $request->image_title_az,
                'image_title_en' => $request->image_title_en,
                'image_title_ru' => $request->image_title_ru,
                'slug' => Str::slug($request->name_en),
                'status' => 1
            ]);

            return redirect()
                ->route('admin.sub-category.index')
                ->with('success', 'Alt kateqoriya uğurla əlavə edildi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
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
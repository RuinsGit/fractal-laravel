<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'sub_category'])->latest()->get();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('back.pages.product.index', compact('products', 'categories', 'sub_categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('back.pages.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'price' => $request->price,
            'image' => $imageName ?? null,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Məhsul uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        return view('back.pages.product.edit', compact('product', 'categories', 'sub_categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            // Köhnə şəkli sil
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'price' => $request->price,
            'image' => $imageName ?? $product->image,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Məhsul uğurla yeniləndi.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();
        return redirect()->route('admin.product.index')
            ->with('success', 'Məhsul uğurla silindi.');
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();
        return response()->json($subCategories);
    }
}

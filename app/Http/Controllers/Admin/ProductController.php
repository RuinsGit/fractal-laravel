<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'sub_category'])
            ->when(request('category_id'), function($q) {
                return $q->where('category_id', request('category_id'));
            })
            ->when(request('sub_category_id'), function($q) {
                return $q->where('sub_category_id', request('sub_category_id')); 
            })
            ->when(request('search'), function($q) {
                return $q->where('title_az', 'LIKE', '%'.request('search').'%')
                        ->orWhere('title_en', 'LIKE', '%'.request('search').'%')
                        ->orWhere('title_ru', 'LIKE', '%'.request('search').'%');
            })
            ->latest()
            ->paginate(request('limit', 10));

        $categories = Category::all();
        $sub_categories = SubCategory::all();
        
        return view('back.pages.product.index', compact('products', 'categories', 'sub_categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        
        return view('back.pages.product.create', compact('categories', 'sub_categories'));
    }

    public function store(Request $request)
    {
        try {
            // Validation kuralları
            $rules = [
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'title_az' => 'required',
                'description_az' => 'required',
                'sale_price' => 'required|numeric',
                'count' => 'required|integer|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ];

            // Validation mesajları
            $messages = [
                'category_id.required' => 'Kateqoriya seçimi mütləqdir',
                'sub_category_id.required' => 'Alt kateqoriya seçimi mütləqdir',
                'title_az.required' => 'Başlıq (AZ) sahəsi mütləqdir',
                'description_az.required' => 'Mətn (AZ) sahəsi mütləqdir',
                'sale_price.required' => 'Satış qiyməti mütləqdir',
                'sale_price.numeric' => 'Satış qiyməti rəqəm olmalıdır',
                'count.required' => 'Məhsul sayı mütləqdir',
                'count.integer' => 'Məhsul sayı tam rəqəm olmalıdır',
                'count.min' => 'Məhsul sayı 0-dan kiçik ola bilməz',
                'image.required' => 'Şəkil mütləqdir',
                'image.image' => 'Fayl şəkil formatında olmalıdır',
                'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya svg olmalıdır',
                'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər'
            ];

            // Validation'ı çalıştır
            $validated = $request->validate($rules, $messages);

            // Resim yükleme
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                // Klasörü oluştur (eğer yoksa)
                $uploadPath = public_path('uploads/products');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                $image->move($uploadPath, $imageName);
            }

            // Ürün oluştur
            $product = Product::create([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'title_az' => $request->title_az,
                'title_en' => $request->title_az, // AZ dilindeki başlığı kullan
                'title_ru' => $request->title_az, // AZ dilindeki başlığı kullan
                'description_az' => $request->description_az,
                'description_en' => $request->description_az, // AZ dilindeki açıklamayı kullan
                'description_ru' => $request->description_az, // AZ dilindeki açıklamayı kullan
                'image' => $imageName ?? null,
                'image_title_az' => $request->image_title_az,
                'image_title_en' => $request->image_title_az, // AZ dilindeki başlığı kullan
                'image_title_ru' => $request->image_title_az, // AZ dilindeki başlığı kullan
                'image_alt_az' => $request->image_alt_az,
                'image_alt_en' => $request->image_alt_az, // AZ dilindeki alt metni kullan
                'image_alt_ru' => $request->image_alt_az, // AZ dilindeki alt metni kullan
                'meta_title_az' => $request->meta_title_az,
                'meta_title_en' => $request->meta_title_az, // AZ dilindeki meta başlığı kullan
                'meta_title_ru' => $request->meta_title_az, // AZ dilindeki meta başlığı kullan
                'meta_description_az' => $request->meta_description_az,
                'meta_description_en' => $request->meta_description_az, // AZ dilindeki meta açıklamayı kullan
                'meta_description_ru' => $request->meta_description_az, // AZ dilindeki meta açıklamayı kullan
                'sale_price' => $request->sale_price,
                'discount' => $request->discount ?? 0,
                'count' => $request->count,
                'slug' => \Str::slug($request->title_az),
                'status' => 1
            ]);

            // Çoklu resim yükleme
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $imageName
                    ]);
                }
            }

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Məhsul uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        
        return view('back.pages.product.edit', compact('product', 'categories', 'sub_categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Validation
            $request->validate([
                'title_az' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'sale_price' => 'required|numeric|min:0',
                'count' => 'required|integer|min:0',
                'discount' => 'nullable|numeric|min:0|max:100',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);

            // Ana resim işleme
            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                    unlink(public_path('uploads/products/' . $product->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $product->image = 'uploads/products/' . $imageName;
            }

            // Ürün bilgilerini güncelle
            $product->update([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'image_title_az' => $request->image_title_az,
                'image_title_en' => $request->image_title_en,
                'image_title_ru' => $request->image_title_ru,
                'image_alt_az' => $request->image_alt_az,
                'image_alt_en' => $request->image_alt_en,
                'image_alt_ru' => $request->image_alt_ru,
                'meta_title_az' => $request->meta_title_az,
                'meta_title_en' => $request->meta_title_en,
                'meta_title_ru' => $request->meta_title_ru,
                'meta_description_az' => $request->meta_description_az,
                'meta_description_en' => $request->meta_description_en,
                'meta_description_ru' => $request->meta_description_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'sale_price' => $request->sale_price,
                'discount' => $request->discount ?? 0,
                'count' => $request->count,
            ]);

            // Çoklu resim işleme
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => 'uploads/products/' . $imageName
                    ]);
                }
            }

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Məhsul uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Ana resmi sil
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }

            // Diğer resimleri sil
            foreach ($product->images as $image) {
                if (file_exists(public_path('uploads/products/' . $image->image))) {
                    unlink(public_path('uploads/products/' . $image->image));
                }
                $image->delete();
            }

            // Ürünü sil
            $product->delete();

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Məhsul uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function getSubCategory($id)
    {
        $sub_categories = SubCategory::where('category_id', $id)->get();
        
        $view = '<option value="">Seçim edin</option>';
        foreach ($sub_categories as $sub_category) {
            $view .= '<option value="'.$sub_category->id.'">'.$sub_category->name_az.'</option>';
        }
        
        return response()->json([
            'status' => 'success',
            'view' => $view
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'sub_category', 'videos'])
            ->withCount('videos as total_videos')
            ->latest()
            ->paginate(10);

        // Her ürün için indirimli fiyatı hesapla
        foreach ($products as $product) {
            $product->final_price = $product->final_price;
        }

        $categories = Category::all();
        $sub_categories = SubCategory::all();

        return view('back.pages.product.index', compact('products', 'categories', 'sub_categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name_az')
            ->get();
        
        return view('back.pages.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            // Debug için
            \Log::info('Product store başladı', $request->all());

            // Thumbnail işlemi
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $this->uploadImage($request->file('thumbnail'), 'products');
                \Log::info('Thumbnail yüklendi', ['path' => $thumbnailPath]);
            }

            // Preview video işlemi
            $previewVideoPath = null;
            if ($request->hasFile('preview_video')) {
                $previewVideoPath = $this->uploadVideo($request->file('preview_video'), 'products/videos/previews');
                \Log::info('Preview video yüklendi', ['path' => $previewVideoPath]);
            }

            // İndirimli fiyat hesaplama
            $price = floatval($request->price);
            $discountPercentage = floatval($request->discount_percentage ?? 0);
            $discountedPrice = $this->calculateDiscountedPrice($price, $discountPercentage);

            \Log::info('Fiyat hesaplandı', [
                'price' => $price,
                'discount' => $discountPercentage,
                'discounted_price' => $discountedPrice
            ]);

            // Ürünü oluştur
            $product = Product::create([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'price' => $price,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedPrice,
                'thumbnail' => $thumbnailPath,
                'preview_video' => $previewVideoPath,
                'status' => $request->status ?? 1,
                'order' => $request->order ?? 0,
                'slug' => $this->createUniqueSlug($request->name_az)
            ]);

            \Log::info('Ürün oluşturuldu', ['product_id' => $product->id]);

            // Video yükleme işlemi
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $key => $video) {
                    $uploadedVideo = ProductVideo::uploadVideo($video, $product->id, $key + 1);
                    \Log::info('Video yüklendi', ['video_id' => $uploadedVideo->id]);
                }
            }

            DB::commit();
            \Log::info('İşlem başarıyla tamamlandı');

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Məhsul uğurla əlavə edildi',
                    'redirect' => route('admin.product.index')
                ]);
            }

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Məhsul uğurla əlavə edildi');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Ürün ekleme hatası', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->cleanupFiles([$thumbnailPath, $previewVideoPath]);

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xəta baş verdi: ' . $e->getMessage()
                ], 422);
            }

            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    // Yardımcı metodlar
    private function uploadImage($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = 'uploads/' . $path;
        
        if (!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath), 0777, true);
        }
        
        $file->move(public_path($uploadPath), $fileName);
        return $uploadPath . '/' . $fileName;
    }

    private function uploadVideo($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = 'uploads/' . $path;
        
        if (!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath), 0777, true);
        }
        
        $file->move(public_path($uploadPath), $fileName);
        return $uploadPath . '/' . $fileName;
    }

    private function calculateDiscountedPrice($price, $discountPercentage)
    {
        if ($discountPercentage > 0) {
            return $price - ($price * $discountPercentage / 100);
        }
        return $price;
    }

    private function cleanupFiles($paths)
    {
        foreach ($paths as $path) {
            if ($path && file_exists(public_path($path))) {
                unlink(public_path($path));
            }
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        
        return view('back.pages.product.edit', compact('product', 'categories', 'sub_categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();

            // Discount percentage null ise 0 olarak ayarla
            $data['discount_percentage'] = $data['discount_percentage'] ?? 0;

            // Resim yükleme işlemi
            if ($request->hasFile('thumbnail')) {
                // Eski resmi sil
                if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                    unlink(public_path($product->thumbnail));
                }

                // Yeni resmi yükle
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                // Klasör yoksa oluştur
                if (!file_exists(public_path('uploads/products'))) {
                    mkdir(public_path('uploads/products'), 0777, true);
                }
                
                $image->move(public_path('uploads/products'), $imageName);
                $data['thumbnail'] = 'uploads/products/' . $imageName;
            }

            // İndirimli fiyat hesaplama
            $price = floatval($request->price);
            $discountPercentage = floatval($request->discount_percentage ?? 0);
            
            // İndirimli fiyatı hesapla
            $discountedPrice = $price;
            if ($discountPercentage > 0) {
                $discountAmount = ($price * $discountPercentage) / 100;
                $discountedPrice = $price - $discountAmount;
            }

            $product->update([
                'name_az' => $data['name_az'],
                'name_en' => $data['name_en'],
                'name_ru' => $data['name_ru'],
                'title_az' => $data['title_az'],
                'title_en' => $data['title_en'],
                'title_ru' => $data['title_ru'],
                'description_az' => $data['description_az'],
                'description_en' => $data['description_en'],
                'description_ru' => $data['description_ru'],
                'category_id' => $data['category_id'],
                'sub_category_id' => $data['sub_category_id'],
                'price' => $price,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedPrice,
                'status' => $data['status'],
                'order' => $data['order'],
                'thumbnail' => $data['thumbnail'] ?? $product->thumbnail
            ]);

            toastr()->success('Məhsul uğurla yeniləndi!');
            return redirect()->route('admin.product.index');

        } catch (\Exception $e) {
            // Hata durumunda yeni yüklenen resmi sil
            if (isset($data['thumbnail']) && file_exists(public_path($data['thumbnail']))) {
                unlink(public_path($data['thumbnail']));
            }

            toastr()->error('Xəta: ' . $e->getMessage());
            return back()->withInput();
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

    public function getSubCategory($category_id)
    {
        try {
            // Kategoriyi kontrol et
            $category = Category::findOrFail($category_id);
            
            // Alt kategorileri getir
            $sub_categories = SubCategory::where('category_id', $category_id)
                ->where('status', 1)
                ->orderBy('name_az')
                ->get();

            if ($sub_categories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bu kateqoriyaya aid alt kateqoriya tapılmadı'
                ]);
            }

            // View'i hazırla
            $view = '<option value="">Seçim edin</option>';
            foreach ($sub_categories as $sub) {
                $view .= '<option value="'.$sub->id.'">'.$sub->name_az.'</option>';
            }

            return response()->json([
                'status' => 'success',
                'view' => $view
            ]);

        } catch (\Exception $e) {
            \Log::error('Alt kategori getirme hatası: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 422);
        }
    }

    public function show($id)
    {
        $product = Product::with('videos')
            ->withCount('videos')
            ->findOrFail($id);

        // Tüm videoların toplam süresini hesapla
        $totalSeconds = $product->videos->sum('duration');
        
        // Toplam süreyi formatla
        if ($totalSeconds < 60) {
            $product->total_duration = $totalSeconds . ' saniyə';
        } elseif ($totalSeconds < 3600) {
            $minutes = floor($totalSeconds / 60);
            $product->total_duration = $minutes . ' dəqiqə';
        } else {
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $product->total_duration = $hours . ' saat ' . ($minutes > 0 ? $minutes . ' dəqiqə' : '');
        }

        // Her video için süreyi formatla
        foreach ($product->videos as $video) {
            $duration = $video->duration;
            if ($duration < 60) {
                $video->formatted_duration = $duration . ' saniyə';
            } elseif ($duration < 3600) {
                $minutes = floor($duration / 60);
                $seconds = $duration % 60;
                $video->formatted_duration = $minutes . ':' . sprintf('%02d', $seconds) . ' dəqiqə';
            } else {
                $hours = floor($duration / 3600);
                $minutes = floor(($duration % 3600) / 60);
                $seconds = $duration % 60;
                $video->formatted_duration = sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
            }
        }

        // Toplam indirme sayısı
        $product->total_downloads = $product->videos->sum('download_count');

        return view('back.pages.product.show', compact('product'));
    }

    /**
     * Başarılı yanıt döndürür
     */
    private function successResponse($route, $message)
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'redirect' => route($route)
            ]);
        }

        toastr()->success($message);
        return redirect()->route($route);
    }

    /**
     * Hata yanıtı döndürür
     */
    private function errorResponse($message)
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => $message
            ], 422);
        }

        toastr()->error($message);
        return back()->withInput();
    }

    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = 1;

        // Slug'ın benzersiz olup olmadığını kontrol et
        while (Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Product::with(['category', 'courseType', 'videos'])
                ->where('status', true);

            // Kategori filtresi
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Kurs türü filtresi
            if ($request->filled('course_type_id')) {
                $query->where('course_type_id', $request->course_type_id);
            }

            // Arama filtresi
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name_az', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%")
                      ->orWhere('name_ru', 'like', "%{$search}%");
                });
            }

            $products = $query->orderBy('order', 'asc')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => ProductResource::collection($products),
                'message' => 'Məhsullar uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product API Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['category', 'courseType', 'videos'])
                ->where('id', $id)
                ->first();

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Məhsul tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new ProductResource($product),
                'message' => 'Məhsul uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product Show API Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
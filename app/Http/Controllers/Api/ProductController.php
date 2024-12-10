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
            $query = Product::with(['category', 'videos'])
                ->where('status', true);

            // Kategori filtresi
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
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

            // Sıralama
            $query->orderBy('order', 'asc')
                  ->orderBy('created_at', 'desc');

            $products = $query->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => ProductResource::collection($products),
                'message' => 'Məhsullar uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            \Log::info('Requested Product ID:', ['id' => $id]);

            $product = Product::with(['category', 'videos'])
                ->where('id', $id)
                ->first();

            \Log::info('Found Product:', ['product' => $product ? $product->toArray() : null]);

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Məhsul tapılmadı',
                    'requested_id' => $id,
                    'debug' => [
                        'available_ids' => Product::pluck('id')->toArray(),
                        'table' => (new Product)->getTable(),
                        'connection' => \DB::connection()->getDatabaseName()
                    ]
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new ProductResource($product),
                'message' => 'Məhsul uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product Show Error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
                'debug_info' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 500);
        }
    }
} 
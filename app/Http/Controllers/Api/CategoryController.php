<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::with('sub_categories')
                ->orderBy('created_at', 'desc')
                ->get();

            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir kateqoriya tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => CategoryResource::collection($categories),
                'message' => 'Kateqoriyalar uğurla gətirildi'
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
            $category = Category::with('sub_categories')->find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kateqoriya tapılmadı',
                    'requested_id' => $id
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new CategoryResource($category),
                'message' => 'Kateqoriya uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
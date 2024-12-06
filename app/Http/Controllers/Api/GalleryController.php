<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        try {
            $galleries = Gallery::latest()->get();

            if ($galleries->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Qalereya şəkilləri tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => GalleryResource::collection($galleries),
                'message' => 'Qalereya şəkilləri uğurla gətirildi'
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
            $gallery = Gallery::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new GalleryResource($gallery),
                'message' => 'Qalereya şəkli uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
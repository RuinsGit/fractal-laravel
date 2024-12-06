<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HumanContentResource;
use App\Models\HumanContent;
use Illuminate\Http\Request;

class HumanContentController extends Controller
{
    public function index()
    {
        try {
            $humanContents = HumanContent::where('status', true)->get();

            if ($humanContents->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'İnsan məzmunu tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => HumanContentResource::collection($humanContents),
                'message' => 'İnsan məzmunu uğurla gətirildi'
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
            $humanContent = HumanContent::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new HumanContentResource($humanContent),
                'message' => 'İnsan məzmunu uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
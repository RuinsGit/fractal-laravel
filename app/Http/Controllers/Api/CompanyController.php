<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $company = Company::where('status', 1)->first();

            if (!$company) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Şirkət məlumatı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new CompanyResource($company),
                'message' => 'Şirkət məlumatı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
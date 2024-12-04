<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $companyCount = Company::count();
        return view('back.home.company.index', compact('companies', 'companyCount'));
    }

    public function create()
    {
        if(Company::count() > 0) {
            return redirect()->route('admin.home.company.index')
                ->with('error', 'Yalnız bir şirkət məlumatı əlavə edilə bilər!');
        }
        return view('back.home.company.create');
    }

    public function store(Request $request)
    {
        if(Company::count() > 0) {
            return redirect()->route('admin.home.company.index')
                ->with('error', 'Yalnız bir şirkət məlumatı əlavə edilə bilər!');
        }

        Company::create([
            'text_1_az' => $request->text_1_az,
            'text_2_az' => $request->text_2_az,
            'text_3_az' => $request->text_3_az,
            'text_1_en' => $request->text_1_en,
            'text_2_en' => $request->text_2_en,
            'text_3_en' => $request->text_3_en,
            'text_1_ru' => $request->text_1_ru,
            'text_2_ru' => $request->text_2_ru,
            'text_3_ru' => $request->text_3_ru,
            'status' => 1
        ]);

        return redirect()->route('admin.home.company.index')
            ->with('success', 'Məlumatlar uğurla əlavə edildi');
    }

    public function status($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->status = !$company->status;
            $company->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status uğurla dəyişdirildi',
                'newStatus' => $company->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi'
            ]);
        }
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('back.home.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update([
            'text_1_az' => $request->text_1_az,
            'text_2_az' => $request->text_2_az,
            'text_3_az' => $request->text_3_az,
            'text_1_en' => $request->text_1_en,
            'text_2_en' => $request->text_2_en,
            'text_3_en' => $request->text_3_en,
            'text_1_ru' => $request->text_1_ru,
            'text_2_ru' => $request->text_2_ru,
            'text_3_ru' => $request->text_3_ru
        ]);

        return redirect()->route('admin.home.company.index')
            ->with('success', 'Məlumatlar uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.home.company.index')
            ->with('success', 'Məlumatlar uğurla silindi');
    }
}

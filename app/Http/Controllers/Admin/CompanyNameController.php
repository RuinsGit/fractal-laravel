<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyName;
use Illuminate\Http\Request;

class CompanyNameController extends Controller
{
    public function index()
    {
        $companyNames = CompanyName::all();
        return view('back.home.company-names.index', compact('companyNames'));
    }

    public function create()
    {
        if (CompanyName::count() > 0) {
            return redirect()->route('admin.home.company-names.index')
                ->with('error', 'Yalnız bir şirkət adı məlumatı əlavə edilə bilər!');
        }
        return view('back.home.company-names.create');
    }

    public function store(Request $request)
    {
        if (CompanyName::count() > 0) {
            return redirect()->route('admin.home.company-names.index')
                ->with('error', 'Yalnız bir şirkət adı məlumatı əlavə edilə bilər!');
        }

        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
        ]);

        CompanyName::create($request->all());

        return redirect()->route('admin.home.company-names.index')
            ->with('success', 'Şirkət adı uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $companyName = CompanyName::findOrFail($id);
        return view('back.home.company-names.edit', compact('companyName'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
        ]);

        $companyName = CompanyName::findOrFail($id);
        $companyName->update($request->all());

        return redirect()->route('admin.home.company-names.index')
            ->with('success', 'Şirkət adı uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $companyName = CompanyName::findOrFail($id);
        $companyName->delete();

        return redirect()->route('admin.home.company-names.index')
            ->with('success', 'Şirkət adı uğurla silindi');
    }

    public function status($id)
    {
        $companyName = CompanyName::findOrFail($id);
        $companyName->status = !$companyName->status;
        $companyName->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $companyName->status
        ]);
    }
}

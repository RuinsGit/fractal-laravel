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
        return view('back.home.company.index', compact('companies'));
    }

    public function create()
    {
        return view('back.home.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_1' => 'required|string',
            'text_2' => 'required|string',
            'text_3' => 'required|string',
        ]);

        Company::create($request->all());

        return redirect()->route('admin.home.company.index')->with('success', 'Şirkət adı uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('back.home.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text_1' => 'required|string',
            'text_2' => 'required|string',
            'text_3' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('admin.home.company.index')->with('success', 'Şirkət adı uğurla yeniləndi.');
    }

    public function status($id)
    {
        $company = Company::findOrFail($id);
        $company->status = !$company->status;
        $company->save();

        return response()->json(['status' => 'success', 'message' => 'Status uğurla yeniləndi.']);
    }
}
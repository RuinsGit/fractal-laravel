<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychologyText;
use Illuminate\Http\Request;

class PsychologyTextController extends Controller
{
    public function index()
    {
        $psychologyTexts = PsychologyText::all();
        return view('back.psychology-text.index', compact('psychologyTexts'));
    }

    public function create()
    {
        return view('back.psychology-text.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
        ]);

        PsychologyText::create([
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.psychology-text.index')
            ->with('success', 'Məlumat uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $psychologyText = PsychologyText::findOrFail($id);
        return view('back.psychology-text.edit', compact('psychologyText'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
        ]);

        $psychologyText = PsychologyText::findOrFail($id);
        
        $psychologyText->update([
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'status' => $request->status ?? $psychologyText->status
        ]);

        return redirect()
            ->route('admin.psychology-text.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        PsychologyText::findOrFail($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $psychologyText = PsychologyText::findOrFail($id);
        $psychologyText->status = !$psychologyText->status;
        $psychologyText->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
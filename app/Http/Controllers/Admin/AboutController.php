<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::firstOrNew();
        return view('back.pages.about', compact('about'));
    }

    public function update(Request $request)
    {
        try {
            $about = About::firstOrNew();

            if ($request->hasFile('image')) {
                if ($about->image && file_exists(public_path($about->image))) {
                    unlink(public_path($about->image));
                }
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about'), $imageName);
                $about->image = 'uploads/about/' . $imageName;
            }

            $about->fill($request->only([
                'title_az',
                'title_en',
                'title_ru',
                'description_az',
                'description_en',
                'description_ru'
            ]));

            $about->save();

            return redirect()
                ->route('admin.about')
                ->with('success', 'Məlumatlar uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }
}

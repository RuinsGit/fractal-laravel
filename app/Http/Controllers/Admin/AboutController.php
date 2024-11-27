<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('back.pages.about', compact('about'));
    }

    public function update(AboutRequest $request)
    {
        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path('uploads/about/' . $about->image))) {
                unlink(public_path('uploads/about/' . $about->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $about->image = $imageName;
        }

        $about->content_az = $request->content_az;
        $about->content_en = $request->content_en;
        $about->content_ru = $request->content_ru;
        $about->save();

        return redirect()->route('admin.about.index')
            ->with('success', 'Haqqımızda məlumatları uğurla yeniləndi.');
    }
}

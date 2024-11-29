<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('back.pages.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('back.pages.gallery.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_az' => 'required',
                'title_en' => 'required',
                'title_ru' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ], [
                'title_az.required' => 'Azərbaycan dilində başlıq daxil edilməlidir',
                'title_en.required' => 'İngilis dilində başlıq daxil edilməlidir',
                'title_ru.required' => 'Rus dilində başlıq daxil edilməlidir',
                'image.required' => 'Şəkil mütləq yüklənməlidir',
                'image.image' => 'Fayl şəkil formatında olmalıdır',
                'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
                'image.max' => 'Şəkil maksimum 2MB ola bilər'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $imageName);
                $imagePath = 'uploads/gallery/' . $imageName;
            }

            $gallery = new Gallery();
            $gallery->title_az = $request->title_az;
            $gallery->title_en = $request->title_en;
            $gallery->title_ru = $request->title_ru;
            $gallery->image = $imagePath ?? null;
            
            $gallery->save();

            toastr()->success('Qalereya müvəffəqiyyətlə əlavə edildi');
            return redirect()->route('admin.gallery.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('back.pages.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ], [
            'title_az.required' => 'Başlıq (AZ) mütləq doldurulmalıdır!',
            'title_en.required' => 'Başlıq (EN) mütləq doldurulmalıdır!',
            'title_ru.required' => 'Başlıq (RU) mütləq doldurulmalıdır!',
            'image.image' => 'Fayl şəkil formatında olmalıdır!',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır!',
            'image.max' => 'Şəkil maksimum 2MB ola bilər!'
        ]);

        if ($request->hasFile('image')) {
            if (File::exists(public_path($gallery->image))) {
                File::delete(public_path($gallery->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $imageName);
            $imagePath = 'uploads/gallery/' . $imageName;
        }

        $gallery->update([
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'image' => $request->hasFile('image') ? $imagePath : $gallery->image
        ]);

        toastr()->success('Qalereya uğurla yeniləndi!');
        return redirect()->route('admin.gallery.index');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (File::exists(public_path($gallery->image))) {
            File::delete(public_path($gallery->image));
        }

        $gallery->delete();

        toastr()->success('Qalereya uğurla silindi!');
        return redirect()->route('admin.gallery.index');
    }
}
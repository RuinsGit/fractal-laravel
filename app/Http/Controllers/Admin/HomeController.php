<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // Header işlemleri
    public function headerIndex()
    {
        $header = Header::first();
        return view('back.home.header.create', compact('header'));
    }

    public function headerStore(Request $request)
    {
        $data = $request->validate([
            'home_az' => 'required|string|max:255',
            'home_en' => 'required|string|max:255',
            'home_ru' => 'required|string|max:255',
            // ... diğer validasyon kuralları ...
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('headers', 'public');
        }

        $header = Header::first();

        if ($header) {
            if ($request->hasFile('image') && $header->image) {
                Storage::disk('public')->delete($header->image);
            }
            $header->update($data);
            $message = 'Header məlumatları uğurla yeniləndi.';
        } else {
            Header::create($data);
            $message = 'Header məlumatları uğurla əlavə edildi.';
        }

        return redirect()->route('admin.home.header.index')->with('success', $message);
    }

    // Title işlemleri
    public function titleIndex()
    {
        return view('back.home.title.index');
    }

    public function titleUpdate(Request $request)
    {
        // Title güncelleme işlemleri
    }

    // Our Advantages işlemleri
    public function ourAdvantagesIndex()
    {
        return view('back.home.ouradvantages.index');
    }

    public function ourAdvantagesUpdate(Request $request)
    {
        // Our Advantages güncelleme işlemleri
    }

    // Study Program işlemleri
    public function studyProgramIndex()
    {
        return view('back.home.studyprogram.index');
    }

    public function studyProgramUpdate(Request $request)
    {
        // Study Program güncelleme işlemleri
    }

    // Partners işlemleri
    public function partnersIndex()
    {
        return view('back.home.partners.index');
    }

    public function partnersUpdate(Request $request)
    {
        // Partners güncelleme işlemleri
    }

    // Services işlemleri
    public function servicesIndex()
    {
        return view('back.home.services.index');
    }

    public function servicesUpdate(Request $request)
    {
        // Services güncelleme işlemleri
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('back.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('back.pages.service.create');
    }

    public function store(ServiceRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
        }

        Service::create([
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $imageName ?? null,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.service.index')
            ->with('success', 'Xidmət uğurla əlavə edildi.');
    }

    public function edit(Service $service)
    {
        return view('back.pages.service.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
                unlink(public_path('uploads/services/' . $service->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
        }

        $service->update([
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $imageName ?? $service->image,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.service.index')
            ->with('success', 'Xidmət uğurla yeniləndi.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }

        $service->delete();
        return redirect()->route('admin.service.index')
            ->with('success', 'Xidmət uğurla silindi.');
    }
}

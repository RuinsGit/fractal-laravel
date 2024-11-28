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
        try {
            // İkon yükleme işlemi
            $iconName = null;
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $iconName = 'uploads/services/' . time() . '.' . $icon->getClientOriginalExtension();
                
                // Klasör yoksa oluştur
                if (!file_exists(public_path('uploads/services'))) {
                    mkdir(public_path('uploads/services'), 0777, true);
                }
                
                // Dosyayı yükle
                if (!$icon->move(public_path('uploads/services'), basename($iconName))) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'İkon yüklənərkən xəta baş verdi');
                }
            }

            // Veritabanına kaydet
            $service = Service::create([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'icon' => $iconName,
                'slug' => Str::slug($request->title_en),
                'status' => 1
            ]);

            if (!$service) {
                // Eğer kayıt başarısız olursa yüklenen dosyayı sil
                if ($iconName && file_exists(public_path($iconName))) {
                    unlink(public_path($iconName));
                }
                
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Məlumatlar yadda saxlanılarkən xəta baş verdi');
            }

            return redirect()
                ->route('admin.service.index')
                ->with('success', 'Xidmət uğurla əlavə edildi!');

        } catch (\Exception $e) {
            // Hata durumunda yüklenen dosyayı sil
            if (isset($iconName) && file_exists(public_path($iconName))) {
                unlink(public_path($iconName));
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $service = Service::findOrFail($id);
            return view('back.pages.service.edit', compact('service'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.service.index')
                ->with('error', 'Xidmət tapılmadı');
        }
    }

    public function update(ServiceRequest $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
            $oldIcon = $service->icon;

            if ($request->hasFile('icon')) {
                // Yeni ikon yükle
                $icon = $request->file('icon');
                $iconName = 'uploads/services/' . time() . '.' . $icon->getClientOriginalExtension();
                
                if (!$icon->move(public_path('uploads/services'), basename($iconName))) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'İkon yüklənərkən xəta baş verdi');
                }

                // Eski ikonu sil
                if ($oldIcon && file_exists(public_path($oldIcon))) {
                    unlink(public_path($oldIcon));
                }

                $service->icon = $iconName;
            }

            $service->update([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'slug' => Str::slug($request->title_en)
            ]);

            return redirect()
                ->route('admin.service.index')
                ->with('success', 'Xidmət uğurla yeniləndi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // İkonu sil
            if ($service->icon && file_exists(public_path($service->icon))) {
                unlink(public_path($service->icon));
            }

            $service->delete();

            return redirect()
                ->route('admin.service.index')
                ->with('success', 'Xidmət uğurla silindi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}

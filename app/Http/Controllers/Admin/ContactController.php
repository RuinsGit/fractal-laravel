<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::firstOrNew();
        return view('back.pages.contact', compact('contact'));
    }

    public function update(Request $request)
    {
        try {
            $contact = Contact::firstOrNew();

            // Logo işleme
            if ($request->hasFile('logo')) {
                if ($contact->logo && file_exists(public_path($contact->logo))) {
                    unlink(public_path($contact->logo));
                }
                $logo = $request->file('logo');
                $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('uploads/contact'), $logoName);
                $contact->logo = 'uploads/contact/' . $logoName;
            }

            // Logo 2 işleme
            if ($request->hasFile('logo_2')) {
                if ($contact->logo_2 && file_exists(public_path($contact->logo_2))) {
                    unlink(public_path($contact->logo_2));
                }
                $logo2 = $request->file('logo_2');
                $logo2Name = time() . '_logo2.' . $logo2->getClientOriginalExtension();
                $logo2->move(public_path('uploads/contact'), $logo2Name);
                $contact->logo_2 = 'uploads/contact/' . $logo2Name;
            }

            
            if ($request->hasFile('favicon')) {
                if ($contact->favicon && file_exists(public_path($contact->favicon))) {
                    unlink(public_path($contact->favicon));
                }
                $favicon = $request->file('favicon');
                $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('uploads/contact'), $faviconName);
                $contact->favicon = 'uploads/contact/' . $faviconName;
            }

           
            $contact->fill($request->only([
                'email',
                'phone',
                'address_az',
                'address_en',
                'address_ru',
                'work_hours_az',
                'work_hours_en',
                'work_hours_ru',
                'facebook',
                'instagram',
                'youtube'
            ]));

            $contact->save();

            return redirect()
                ->route('admin.contact')
                ->with('success', 'Məlumatlar uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }
}

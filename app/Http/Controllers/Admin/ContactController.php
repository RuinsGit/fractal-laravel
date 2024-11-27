<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('back.pages.contact', compact('contact'));
    }

    public function update(ContactRequest $request)
    {
        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
        }

        $contact->update([
            'address_az' => $request->address_az,
            'address_en' => $request->address_en,
            'address_ru' => $request->address_ru,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin
        ]);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Əlaqə məlumatları uğurla yeniləndi.');
    }
}

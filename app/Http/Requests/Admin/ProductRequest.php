<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_az' => 'required|max:255',
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpg,jpeg,png,svg' : 'nullable|image|mimes:jpg,jpeg,png,svg',
            'price' => 'required|numeric',
            // ... diğer kurallar
        ];
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Başlıq (Az) tələb olunur',
            'title_en.required' => 'Başlıq (En) tələb olunur',
            'title_ru.required' => 'Başlıq (Ru) tələb olunur',
            'category_id.required' => 'Kateqoriya seçilməlidir',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
            'sub_category_id.required' => 'Alt kateqoriya seçilməlidir',
            'sub_category_id.exists' => 'Seçilmiş alt kateqoriya mövcud deyil',
            // ... diğer mesajlar
        ];
    }
}

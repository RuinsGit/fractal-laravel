<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content_az' => 'required',
            'content_en' => 'required',
            'content_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'content_az.required' => 'Məzmun (AZ) tələb olunur',
            'content_en.required' => 'Məzmun (EN) tələb olunur',
            'content_ru.required' => 'Məzmun (RU) tələb olunur',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya webp olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
        ];
    }
}

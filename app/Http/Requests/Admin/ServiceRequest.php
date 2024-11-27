<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'status' => 'nullable|boolean'
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Xidmət başlığı (AZ) tələb olunur',
            'title_en.required' => 'Xidmət başlığı (EN) tələb olunur',
            'title_ru.required' => 'Xidmət başlığı (RU) tələb olunur',
            'description_az.required' => 'Xidmət təsviri (AZ) tələb olunur',
            'description_en.required' => 'Xidmət təsviri (EN) tələb olunur',
            'description_ru.required' => 'Xidmət təsviri (RU) tələb olunur',
            'image.required' => 'Şəkil tələb olunur',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya webp olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
        ];
    }
}
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
        return [
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'icon' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title_az.required' => 'Zəhmət olmasa, Azərbaycan dilində başlıq daxil edin',
            'title_en.required' => 'Zəhmət olmasa, İngilis dilində başlıq daxil edin',
            'title_ru.required' => 'Zəhmət olmasa, Rus dilində başlıq daxil edin',
            'icon.required' => 'Zəhmət olmasa, ikon seçin',
            'icon.image' => 'Fayl şəkil formatında olmalıdır',
            'icon.mimes' => 'İkon formatı: jpeg, png, jpg, svg və ya webp olmalıdır',
            'icon.max' => 'İkon həcmi maksimum 2MB ola bilər',
        ];
    }
}

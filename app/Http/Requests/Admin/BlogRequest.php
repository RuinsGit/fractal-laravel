<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title_az' => 'required|max:255',
            'title_en' => 'required|max:255',
            'title_ru' => 'required|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'status' => 'required|in:0,1',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title_az.required' => 'Azərbaycan dilində başlıq daxil edin',
            'title_en.required' => 'İngilis dilində başlıq daxil edin',
            'title_ru.required' => 'Rus dilində başlıq daxil edin',
            'description_az.required' => 'Azərbaycan dilində mətn daxil edin',
            'description_en.required' => 'İngilis dilində mətn daxil edin',
            'description_ru.required' => 'Rus dilində mətn daxil edin',
            'image.required' => 'Şəkil seçin',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, gif olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
            'status.required' => 'Status seçin',
            'status.in' => 'Status yanlışdır',
        ];
    }
}
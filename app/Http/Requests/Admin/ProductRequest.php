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
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'price' => 'required|numeric|min:0',
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
            'category_id.required' => 'Kateqoriya seçilməlidir',
            'sub_category_id.required' => 'Alt kateqoriya seçilməlidir',
            'title_az.required' => 'Məhsul başlığı (AZ) tələb olunur',
            'title_en.required' => 'Məhsul başlığı (EN) tələb olunur',
            'title_ru.required' => 'Məhsul başlığı (RU) tələb olunur',
            'description_az.required' => 'Məhsul təsviri (AZ) tələb olunur',
            'description_en.required' => 'Məhsul təsviri (EN) tələb olunur',
            'description_ru.required' => 'Məhsul təsviri (RU) tələb olunur',
            'price.required' => 'Qiymət tələb olunur',
            'price.numeric' => 'Qiymət rəqəm olmalıdır',
            'price.min' => 'Qiymət mənfi ola bilməz',
            'image.required' => 'Şəkil tələb olunur',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya webp olmalıdır',
            'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
        ];
    }
}

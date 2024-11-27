<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'status' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kateqoriya seçilməlidir',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
            'name_az.required' => 'Alt kateqoriya adı (AZ) tələb olunur',
            'name_en.required' => 'Alt kateqoriya adı (EN) tələb olunur',
            'name_ru.required' => 'Alt kateqoriya adı (RU) tələb olunur',
        ];
    }
}

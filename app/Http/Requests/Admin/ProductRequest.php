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
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name_az.required' => 'Ad (AZ) tələb olunur',
            'name_en.required' => 'Ad (EN) tələb olunur',
            'name_ru.required' => 'Ad (RU) tələb olunur',
            'name_az.max' => 'Ad (AZ) maksimum 255 simvol ola bilər',
            'name_en.max' => 'Ad (EN) maksimum 255 simvol ola bilər',
            'name_ru.max' => 'Ad (RU) maksimum 255 simvol ola bilər',
            'title_az.required' => 'Başlıq (AZ) tələb olunur',
            'title_en.required' => 'Başlıq (EN) tələb olunur',
            'title_ru.required' => 'Başlıq (RU) tələb olunur',
            'title_az.max' => 'Başlıq (AZ) maksimum 255 simvol ola bilər',
            'title_en.max' => 'Başlıq (EN) maksimum 255 simvol ola bilər',
            'title_ru.max' => 'Başlıq (RU) maksimum 255 simvol ola bilər',
            'description_az.required' => 'Təsvir (AZ) tələb olunur',
            'description_en.required' => 'Təsvir (EN) tələb olunur',
            'description_ru.required' => 'Təsvir (RU) tələb olunur',
            'category_id.required' => 'Kateqoriya seçilməlidir',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
            'sub_category_id.required' => 'Alt kateqoriya seçilməlidir',
            'sub_category_id.exists' => 'Seçilmiş alt kateqoriya mövcud deyil',
            'price.required' => 'Qiymət tələb olunur',
            'price.numeric' => 'Qiymət rəqəm olmalıdır',
            'price.min' => 'Qiymət 0-dan kiçik ola bilməz',
            'discount_percentage.numeric' => 'Endirim faizi rəqəm olmalıdır',
            'discount_percentage.min' => 'Endirim faizi 0-dan kiçik ola bilməz',
            'discount_percentage.max' => 'Endirim faizi 100-dən böyük ola bilməz',
            'status.required' => 'Status seçilməlidir',
            'status.boolean' => 'Status yalnız aktiv və ya deaktiv ola bilər',
            'order.required' => 'Sıra tələb olunur',
            'order.integer' => 'Sıra tam rəqəm olmalıdır',
            'order.min' => 'Sıra 0-dan kiçik ola bilməz',
            'thumbnail.image' => 'Fayl şəkil formatında olmalıdır',
            'thumbnail.mimes' => 'Şəkil formatı: jpg, jpeg, png və ya gif olmalıdır',
            'thumbnail.max' => 'Şəkil həcmi maksimum 2MB ola bilər',
            'preview_video.mimes' => 'Video formatı: mp4, mov və ya ogg olmalıdır',
            'preview_video.max' => 'Video həcmi maksimum 20MB ola bilər',
            'videos.*.mimes' => 'Video formatı: mp4, mov və ya ogg olmalıdır',
            'videos.*.max' => 'Video həcmi maksimum 20MB ola bilər',
            'video_titles.*.required_with' => 'Video başlığı tələb olunur'
        ];
    }
}

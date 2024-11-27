<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('back.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('back.pages.blog.create');
    }

    public function store(BlogRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        }

        Blog::create([
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $imageName ?? null,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog uğurla əlavə edildi.');
    }

    public function edit(Blog $blog)
    {
        return view('back.pages.blog.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
                unlink(public_path('uploads/blogs/' . $blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        }

        $blog->update([
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $imageName ?? $blog->image,
            'slug' => Str::slug($request->title_en),
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog uğurla yeniləndi.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
            unlink(public_path('uploads/blogs/' . $blog->image));
        }

        $blog->delete();
        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog uğurla silindi.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/blogs'), $imageName);
                $data['image'] = 'uploads/blogs/' . $imageName;
            }

            $data['slug'] = Str::slug($request->title_en);
            $data['view_count'] = 0;
            $data['published_at'] = now();

            Blog::create($data);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            return view('back.pages.blog.edit', compact('blog'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.blog.index')
                ->with('error', 'Blog tapılmadı');
        }
    }

    public function update(BlogRequest $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($blog->image && File::exists(public_path($blog->image))) {
                    File::delete(public_path($blog->image));
                }

                // Yeni resmi yükle
                $image = $request->file('image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/blogs'), $imageName);
                $data['image'] = 'uploads/blogs/' . $imageName;
            }

            $data['slug'] = Str::slug($request->title_en);
            $blog->update($data);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $blog->delete();

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->status = !$blog->status;
            $blog->save();

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Status uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}

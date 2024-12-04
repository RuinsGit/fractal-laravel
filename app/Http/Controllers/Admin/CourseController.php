<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('back.course.index', compact('courses'));
    }

    public function create()
    {
        return view('back.course.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/courses/');
            $image->move($destinationPath, $name);
        }

        Course::create([
            'image' => '/uploads/courses/' . $name,
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.course.index')
            ->with('success', 'Kurs uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('back.course.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        $course = Course::findOrFail($id);

        if($request->hasFile('image')) {
            // Delete old image
            if(File::exists(public_path($course->image))) {
                File::delete(public_path($course->image));
            }
            
            // Upload new image
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/courses/');
            $image->move($destinationPath, $name);
            
            $course->image = '/uploads/courses/' . $name;
        }

        $course->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.course.index')
            ->with('success', 'Kurs uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        if(File::exists(public_path($course->image))) {
            File::delete(public_path($course->image));
        }
        
        $course->delete();

        return redirect()
            ->route('admin.course.index')
            ->with('success', 'Kurs uğurla silindi');
    }

    public function status($id)
    {
        $course = Course::findOrFail($id);
        $course->status = !$course->status;
        $course->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
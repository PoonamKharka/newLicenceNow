<?php

namespace App\Repositories\Repository;

use App\Models\DrivingLesson;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\DrivingLessonRepositoryInterface;

class DrivingLessonRepository implements DrivingLessonRepositoryInterface
{

    public function getAllDrivingLessons(Request $request)
    {
        $drivingLessons = DrivingLesson::all();
        return view('admin.drivinglesson.index', compact('drivingLessons'));
    }
    public function profile()
    {
        $drivinglesson = DrivingLesson::first();
        return view('admin.drivinglesson.profile', compact('drivinglesson'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'description' => 'required',
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_image.' . $image->getClientOriginalExtension();
            $validatedData['image'] = $image->storeAs('drivingLessonProfile', $imageName, 'public');
        }

        // Determine if we're updating or creating
        $drivingLesson = DrivingLesson::updateOrCreate(
            ['id' => $request->input('id')], // Conditions for update
            $validatedData // Data to be inserted or updated
        );

        // Redirect based on update or create
        if ($request->input('id')) {
            return view('admin.drivinglesson.profile', compact('drivingLesson'))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()->route('lessons.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $drivingLesson = DrivingLesson::findOrFail($id);
        return view('admin.drivinglesson.profile', compact('drivingLesson'));
    }
}

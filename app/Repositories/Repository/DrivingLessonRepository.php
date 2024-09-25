<?php

namespace App\Repositories\Repository;

use App\Models\DrivingLesson;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\DrivingLessonRepositoryInterface;

class DrivingLessonRepository implements DrivingLessonRepositoryInterface
{

    public function getAllDrivingLessons(Request $request)
    {
        //$drivingLessons = DrivingLesson::all();
        if ($request->ajax()) {
            $drivingLessons = DrivingLesson::select('*');
            return datatables()->of($drivingLessons)

                // Add an image column
                ->addColumn('image', function ($row) {
                    // Check if the image exists and render it
                    $imageUrl = asset('storage/' . $row->image);
                    return '<img src="' . $imageUrl . '" alt="' . $row->title . '" width="100" height="100">';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('lessons.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.drivinglesson.index');
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
        $drivingLessonId = decrypt($id);

        // Find the corresponding driving lesson
        $drivingLesson = DrivingLesson::findOrFail($drivingLessonId);

        // Pass the lesson to the view for editing
        return view('admin.drivinglesson.profile', compact('drivingLesson'));
    }
}

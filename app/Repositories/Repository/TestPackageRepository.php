<?php

namespace App\Repositories\Repository;

use App\Models\TestPackage;
use App\Repositories\InterFaces\TestPackageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestPackageRepository implements TestPackageRepositoryInterface
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $testPackages = TestPackage::all();
            return datatables()
                ->of($testPackages)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = asset('storage/' . $row->image);
                    return '<img src="' . $imageUrl . '" alt="' . $row->title . '" width="100" height="100"/>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('testpackages.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('admin.testpackage.index');
    }
    public function create()
    {
        return view('admin.testpackage.create-update');
    }
    // perform create and update lesson
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
            $validatedData['image'] = $image->storeAs('testPackages', $imageName, 'public');
        }

        // Determine if we're updating or creating
        $testPackage = TestPackage::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('testpackages.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('testpackages.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $testPackageId = decrypt($id);

        $testPackage = TestPackage::findOrFail($testPackageId);

        return view('admin.testpackage.create-update', compact('testPackage'));
    }
    
    public function delete($id)
    {
        $lesson = TestPackage::find($id);
        $lesson->delete();
        return redirect()->route('testpackages.index')->with('status', 'User deleted successfully.');
    }
}
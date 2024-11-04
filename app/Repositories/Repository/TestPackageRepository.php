<?php

namespace App\Repositories\Repository;

use App\Models\TestPackage;
use App\Repositories\InterFaces\TestPackageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ImageUploadService;

class TestPackageRepository implements TestPackageRepositoryInterface
{
    protected $imageUploadService;
    // Constructor to inject the ImageUploadService
    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $testPackages = TestPackage::orderBy('created_at', 'DESC')->get();
            return datatables()
                ->of($testPackages)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = $row->img_path;
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
            'listing' => 'required',
            'disclaimer' => 'required',
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $imagePaths = $this->imageUploadService->uploadImage($request->file('image'),'testPackages');
        }
        if (!empty($imagePaths)) {
            $validatedData['img_path'] = $imagePaths; 
            $validatedData['image'] = $imagePaths; 
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
        $testPackage = TestPackage::find($id);
        $testPackage->delete();
        return redirect()->route('testpackages.index')->with('status', 'Test Package deleted successfully.');
    }
}
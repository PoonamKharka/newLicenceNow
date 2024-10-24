<?php

namespace App\Repositories\Repository;

use App\Models\Feature;
use App\Repositories\InterFaces\FeaturesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ImageUploadService;

class FeaturesRepository implements FeaturesRepositoryInterface
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
            $features = Feature::select('*')->orderBy('created_at', 'DESC');
            return datatables()
                ->of($features)
                ->addColumn('description', function ($row) {
                    return Str::limit(html_entity_decode(strip_tags($row->description)), 50, '...');
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = $row->image;
                    return '<img src="' . $imageUrl . '" alt="' . $row->title . '" width="100" height="100"/>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('features.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('admin.article.features.index');
    }
    public function create()
    {
        return view('admin.article.features.create-update');
    }
    // perform create and update lesson
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:svg|max:2048',
            'description' => 'required',
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $imagePaths = $this->imageUploadService->uploadImage($request->file('image'),'features');
        }
        if (!empty($imagePaths)) {
            $validatedData['image_path'] = $imagePaths; 
            $validatedData['image'] = $imagePaths; 
        }
        // Determine if we're updating or creating
        $feature = Feature::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('features.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('features.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $featureId = decrypt($id);

        $feature = Feature::findOrFail($featureId);

        return view('admin.article.features.create-update', compact('feature'));
    }
    
    public function delete($id)
    {
        $feature = Feature::find($id);
        $feature->delete();
        return redirect()->route('features.index')->with('status', 'Test Package deleted successfully.');
    }
}
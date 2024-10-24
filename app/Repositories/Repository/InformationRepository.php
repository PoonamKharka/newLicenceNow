<?php

namespace App\Repositories\Repository;

use App\Models\Information;
use App\Repositories\InterFaces\InformationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformationRepository implements InformationRepositoryInterface
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $information = Information::all();
            return datatables()
                ->of($information)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('informations.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.information.index');
    }
    public function create()
    {
        return view('admin.information.create-update');
    }
    // perform create and update lesson
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required',            
            'description' => 'required',
        ]);

       
        // Determine if we're updating or creating
        $information = Information::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('informations.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('informations.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $informationId = decrypt($id);

        $information = Information::findOrFail($informationId);

        return view('admin.information.create-update', compact('information'));
    }
    
    public function delete($id)
    {
        $information = Information::find($id);
        $information->delete();
        return redirect()->route('informations.index')->with('status', 'Artica deleted successfully.');
    }
}
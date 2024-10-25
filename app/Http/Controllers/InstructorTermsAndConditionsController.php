<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstructorTermsAndCondition;
use Illuminate\Support\Str;

class InstructorTermsAndConditionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instructorTermsAndCondition = InstructorTermsAndCondition::orderBy('created_at', 'DESC')->get();
            return datatables()
                ->of($instructorTermsAndCondition)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('instructor-terms-and-condition.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['description','action'])
                ->make(true);
        }
        return view('admin.article.instructortermsandconditions.index');
    }
    public function create()
    {
        return view('admin.article.instructortermsandconditions.create-update');
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
        $instructorTermsAndCondition = InstructorTermsAndCondition::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('instructor-terms-and-condition.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('instructor-terms-and-condition.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $instructorTermsAndConditionId = decrypt($id);

        $instructorTermsAndCondition = InstructorTermsAndCondition::findOrFail($instructorTermsAndConditionId);

        return view('admin.article.instructortermsandconditions.create-update', compact('instructorTermsAndCondition'));
    }
    
    public function destroy($id)
    {
        $instructorTermsAndCondition = InstructorTermsAndCondition::find($id);
        $instructorTermsAndCondition->delete();
        return redirect()->route('instructor-terms-and-condition.index')->with('status', 'Instructor Terms And Condition deleted successfully.');
    }
}
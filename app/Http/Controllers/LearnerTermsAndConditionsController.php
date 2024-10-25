<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearnerTermsAndCondition;
use Illuminate\Support\Str;

class LearnerTermsAndConditionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $learnerTermsAndCondition = LearnerTermsAndCondition::orderBy('created_at', 'DESC')->get();
            return datatables()
                ->of($learnerTermsAndCondition)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('learner-terms-and-condition.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['description','action'])
                ->make(true);
        }
        return view('admin.article.learnertermsandconditions.index');
    }
    public function create()
    {
        return view('admin.article.learnertermsandconditions.create-update');
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
        $learnerTermsAndCondition = LearnerTermsAndCondition::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('learner-terms-and-condition.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('learner-terms-and-condition.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $learnerTermsAndConditionId = decrypt($id);

        $learnerTermsAndCondition = LearnerTermsAndCondition::findOrFail($learnerTermsAndConditionId);

        return view('admin.article.learnertermsandconditions.create-update', compact('learnerTermsAndCondition'));
    }
    
    public function destroy($id)
    {
        $learnerTermsAndCondition = LearnerTermsAndCondition::find($id);
        $learnerTermsAndCondition->delete();
        return redirect()->route('learner-terms-and-condition.index')->with('status', 'Learner Terms And Condition deleted successfully.');
    }
}
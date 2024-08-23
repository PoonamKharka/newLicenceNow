<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorRepository implements InstructorRepositoryInterFace {

    public function getAllInstructors(Request $request) {

        if($request->ajax()) {
            $instrutors = User::whereHas('userType' , function ( $query) {
                $query->where('type', '=', 'Instructor');
            })->select('*');

            return datatables()->of($instrutors)
                    ->editColumn('status' , function($row) {
                        if( $row->status == 1) {
                            return 'Active';
                        } else {
                            return 'Inactive';
                        }
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('users.show', encrypt($row->id)) .'" class="btn btn-sm btn-info">Add More Details</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.instructor.index'); 
    }
}
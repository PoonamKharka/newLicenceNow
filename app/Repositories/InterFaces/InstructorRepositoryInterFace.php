<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface InstructorRepositoryInterFace {
    public function getAllInstructors(Request $request);
    public function profile($id);
    public function store(Request $request);
    public function validatePhone(Request $request);
    public function validateSalaryPayModeId(Request $request);
    public function getAllInstructorsRquest(Request $request);
    public function updateInstructorStatus(Request $request);
    public function showInstructorRequest($id);
    public function updateAttachments(Request $request,$id);
}

?>
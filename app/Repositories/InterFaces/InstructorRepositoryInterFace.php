<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface InstructorRepositoryInterFace {
    public function getAllInstructors(Request $request);
    public function profile($request, $id);
    public function store(Request $request);
}

?>
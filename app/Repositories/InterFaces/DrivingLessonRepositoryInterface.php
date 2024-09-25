<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface DrivingLessonRepositoryInterface
{
    public function getAllDrivingLessons(Request $request);
    public function profile();
    public function store(Request $request);
    public function edit($id);
}

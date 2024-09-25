<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface DrivingLessonRepositoryInterface
{
    public function index(Request $request);    
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function delete($id);
}
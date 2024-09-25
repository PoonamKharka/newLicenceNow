<?php

namespace App\Services;

use App\Repositories\InterFaces\DrivingLessonRepositoryInterface;
use Illuminate\Http\Request;

class DrivingLessonService
{
      protected $dlRep;

      public function __construct(DrivingLessonRepositoryInterface $dlRepository)
      {
            $this->dlRep = $dlRepository;
      }

      public function getAllDrivingLessons(Request $request)
      {
            return $this->dlRep->getAllDrivingLessons($request);
      }

      public function profile()
      {
            return $this->dlRep->profile();
      }

      public function store(Request $request)
      {
            return $this->dlRep->store($request);
      }
      public function edit($id)
      {
            return $this->dlRep->edit($id);
      }
}
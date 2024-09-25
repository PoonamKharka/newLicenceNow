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

      public function index(Request $request)
      {
            return $this->dlRep->index($request);
      }

      public function create()
      {
            return $this->dlRep->create();
      }
      public function store(Request $request)
      {
            return $this->dlRep->store($request);
      }
      public function edit($id)
      {
            return $this->dlRep->edit($id);
      }
      
      public function delete($id)
      {
            return $this->dlRep->delete($id);
      }
}
<?php

namespace App\Services;

use App\Repositories\InterFaces\LearnerRepositoryInterface;
use Illuminate\Http\Request;

class  LearnerService
{
      protected $learnRep;
      
      public function __construct(LearnerRepositoryInterface $learnerRepository)
      {
            $this->learnRep = $learnerRepository;
      }
      public function getAllLearners(Request $request)
      {
            return $this->learnRep->getAllLearners($request);
      }

      public function profile($request, $id)
      {
            return $this->learnRep->profile($request, $id);
      }

      public function store(Request $request)
      {
            return $this->learnRep->store($request);
      }
}

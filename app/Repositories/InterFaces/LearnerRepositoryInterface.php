<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface LearnerRepositoryInterface{

      public function getAllLearners(Request $request);
      public function profile($request, $id);
      public function store(Request $request);
  
}

?>
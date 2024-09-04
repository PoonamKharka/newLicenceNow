<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface AboutUsRepositoryInterface
{
      public function profile();
      public function store(Request $request);
}

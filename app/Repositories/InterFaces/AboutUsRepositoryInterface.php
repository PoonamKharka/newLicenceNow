<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface AboutUsRepositoryInterface
{
      public function getAboutUsList($req);
      public function profile();
      public function editRecord($id);
      public function store(Request $request);
      public function destroy($id);
}

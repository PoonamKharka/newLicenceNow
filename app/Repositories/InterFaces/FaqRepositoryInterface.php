<?php 

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface FaqRepositoryInterface{
      public function getAllFaqs(Request $request);
      public function profile();
      public function store(Request $request);
      public function edit($id);
}

?>
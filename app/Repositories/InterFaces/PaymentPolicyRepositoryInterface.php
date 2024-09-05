<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;


interface PaymentPolicyRepositoryInterface
{
      public function profile();
      public function store(Request $request);
      
      
}
?>
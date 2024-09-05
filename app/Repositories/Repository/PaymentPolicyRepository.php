<?php

namespace App\Repositories\Repository;

use App\Models\PaymentPolicy;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\PaymentPolicyRepositoryInterface;


class  PaymentPolicyRepository implements PaymentPolicyRepositoryInterface 
{
      public function profile()
      {

            $payPolicys = PaymentPolicy::first();
            return view('admin.paymentpolicy.profile', compact('payPolicys'));
      }

      public function store(Request $request)
      {
            dd($request->all());
      }

}






?>
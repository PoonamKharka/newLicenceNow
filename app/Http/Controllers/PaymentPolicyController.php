<?php

namespace App\Http\Controllers;

use App\Services\PaymentPolicyService;
use Illuminate\Http\Request;

class PaymentPolicyController extends Controller
{
      protected $payPolicyService;

      public function __construct(PaymentPolicyService  $paymentPolicyService)
      {
            return $this->payPolicyService = $paymentPolicyService;
            
      }

      public function create( )
      {
            return $this->payPolicyService->profile();
      }

      public function store(Request $request)
      {
            return $this->payPolicyService->store($request);
      }
}

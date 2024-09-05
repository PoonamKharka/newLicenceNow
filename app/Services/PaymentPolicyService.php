<?php 

namespace App\Services;

use App\Repositories\InterFaces\PaymentPolicyRepositoryInterface;
use Illuminate\Http\Request;

class PaymentPolicyService
{

      protected  $payPolicyRep;

      public function __construct(PaymentPolicyRepositoryInterface $paymentPolicyRepository)
      {
            return $this->payPolicyRep = $paymentPolicyRepository;   
      }

      public function profile()
      {
            return $this->payPolicyRep->profile();
      }

      public function store($request)
      {
            return $this->payPolicyRep->store($request);
      }
}


?>
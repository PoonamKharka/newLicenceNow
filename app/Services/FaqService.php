<?php
namespace App\Services;

use App\Repositories\InterFaces\FaqRepositoryInterface;
use Illuminate\Http\Request;

class FaqService
{
      protected $faqRep;

      public function __construct(FaqRepositoryInterface $faqRepository)
      {
            $this->faqRep = $faqRepository;
      }

      public function getAllFaqs(Request $request)
      {
            return $this->faqRep->getAllFaqs($request);
      }

      public function profile()
      {
          return $this->faqRep->profile();
      }

      public function store(Request $request)
      {
            return $this->faqRep->store($request);
      }

      public function edit($id)
      {
            return $this->faqRep->edit($id);
      }
}

?>
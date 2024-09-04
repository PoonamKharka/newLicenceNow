<?php

namespace App\Services;

use App\Repositories\InterFaces\AboutUsRepositoryInterface;
use Illuminate\Http\Request;

class AboutUsService
{
      protected $abtUsRep;

      public function __construct(AboutUsRepositoryInterface $aboutUsRepository)
      {
            $this->abtUsRep = $aboutUsRepository;
      }

      public function profile()
      {
            return $this->abtUsRep->profile();
      }
      public function store($request)
      {
            return $this->abtUsRep->store($request);
      }
}

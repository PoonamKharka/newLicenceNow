<?php

namespace App\Services;

use App\Repositories\InterFaces\FeaturesRepositoryInterface;
use Illuminate\Http\Request;

class FeaturesService
{
      protected $featureRep;

      public function __construct(FeaturesRepositoryInterface $featureRepository)
      {
            $this->featureRep = $featureRepository;
      }

      public function index(Request $request)
      {
            return $this->featureRep->index($request);
      }

      public function create()
      {
            return $this->featureRep->create();
      }
      public function store(Request $request)
      {
            return $this->featureRep->store($request);
      }
      public function edit($id)
      {
            return $this->featureRep->edit($id);
      }
      
      public function delete($id)
      {
            return $this->featureRep->delete($id);
      }
}
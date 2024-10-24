<?php

namespace App\Services;

use App\Repositories\InterFaces\InformationRepositoryInterface;
use Illuminate\Http\Request;

class InformationService
{
      protected $informationRep;

      public function __construct(InformationRepositoryInterface $informationRepository)
      {
            $this->informationRep = $informationRepository;
      }

      public function index(Request $request)
      {
            return $this->informationRep->index($request);
      }

      public function create()
      {
            return $this->informationRep->create();
      }
      public function store(Request $request)
      {
            return $this->informationRep->store($request);
      }
      public function edit($id)
      {
            return $this->informationRep->edit($id);
      }
      
      public function delete($id)
      {
            return $this->informationRep->delete($id);
      }
}
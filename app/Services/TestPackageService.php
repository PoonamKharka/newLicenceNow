<?php

namespace App\Services;

use App\Repositories\InterFaces\TestPackageRepositoryInterface;
use Illuminate\Http\Request;

class TestPackageService
{
      protected $tpRep;

      public function __construct(TestPackageRepositoryInterface $tpRepository)
      {
            $this->tpRep = $tpRepository;
      }

      public function index(Request $request)
      {
            return $this->tpRep->index($request);
      }

      public function create()
      {
            return $this->tpRep->create();
      }
      public function store(Request $request)
      {
            return $this->tpRep->store($request);
      }
      public function edit($id)
      {
            return $this->tpRep->edit($id);
      }
      
      public function delete($id)
      {
            return $this->tpRep->delete($id);
      }
}
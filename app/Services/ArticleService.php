<?php

namespace App\Services;

use App\Repositories\InterFaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleService
{
      protected $articleRep;

      public function __construct(ArticleRepositoryInterface $articleRepository)
      {
            $this->articleRep = $articleRepository;
      }

      public function index(Request $request)
      {
            return $this->articleRep->index($request);
      }

      public function create()
      {
            return $this->articleRep->create();
      }
      public function store(Request $request)
      {
            return $this->articleRep->store($request);
      }
      public function edit($id)
      {
            return $this->articleRep->edit($id);
      }
      
      public function delete($id)
      {
            return $this->articleRep->delete($id);
      }
}
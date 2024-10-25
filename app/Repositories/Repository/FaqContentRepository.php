<?php

namespace App\Repositories\Repository;

use App\Models\FaqContent;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\FaqContentRepositoryInterface;

class FaqContentRepository implements FaqContentRepositoryInterface
{
    public function store($data)
    {
       return FaqContent::create($data); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\AboutUsService;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    protected $abtUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        return $this->abtUsService  = $aboutUsService;
    }

    public function create()
    {
        return $this->abtUsService->profile();
    }

    public function store(Request $request)
    {
        return $this->abtUsService->store($request);
    }
    
}

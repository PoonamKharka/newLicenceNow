<?php

namespace App\Http\Controllers;

use App\Services\LearnerService;
use Illuminate\Http\Request;

class LearnerController extends Controller
{

    protected $learnService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(LearnerService $learnerService)
    {
        return $this->learnService = $learnerService;
    }


    public function index(Request $request)
    {
        return $this->learnService->getAllLearners($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Request $request, $id)
   {
      return $this->learnService->profile($request, $id);
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->learnService->store($request);
    }

}

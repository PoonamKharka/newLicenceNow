<?php

namespace App\Http\Controllers;

use App\Services\FeaturesService;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    protected $featureService;

    public function __construct(FeaturesService $featureService)
    {
        return $this->featureService = $featureService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->featureService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->featureService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->featureService->store($request);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->featureService->edit($id);
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->featureService->delete($id);
    }
}
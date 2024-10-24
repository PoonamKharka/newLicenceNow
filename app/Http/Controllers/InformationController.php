<?php

namespace App\Http\Controllers;

use App\Services\InformationService;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    protected $informationService;

    public function __construct(InformationService $informationService)
    {
        return $this->informationService = $informationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->informationService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->informationService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->informationService->store($request);
        
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
        return $this->informationService->edit($id);
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->informationService->delete($id);
    }
}
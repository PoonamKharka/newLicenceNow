<?php

namespace App\Http\Controllers;

use App\Services\TestPackageService;
use Illuminate\Http\Request;

class TestPackageController extends Controller
{
    protected $tpService;

    public function __construct(TestPackageService $tpService)
    {
        return $this->tpService = $tpService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->tpService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->tpService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->tpService->store($request);
        
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
        return $this->tpService->edit($id);
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->tpService->delete($id);
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\DrivingLessonService;
use Illuminate\Http\Request;

class DrivingLessonController extends Controller
{
    protected $dlService;

    public function __construct(DrivingLessonService $dlService)
    {
        return $this->dlService = $dlService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->dlService->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->dlService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->dlService->store($request);
        
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
        return $this->dlService->edit($id);
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->dlService->delete($id);
    }
}
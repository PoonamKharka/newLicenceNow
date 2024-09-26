<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LessonService;
use App\Models\Location;
use App\Models\Price;

class LessonController extends Controller
{

    protected $lessonService;

    /** Injecting service class */
    public function __construct(LessonService $lessonService){
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->lessonService->getAllLesson($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::get();
        $prices = Price::get();
        return view('admin.lessons.create', compact(['locations', 'prices']));
    }

    /**
     * Store a newly created resource in storage.                      
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        //dd($request->all());
        try {
            $insert = $this->lessonService->addLesson($request->all());
        } catch (\Exception $ex) {
            dd($ex);
        }
        
       // dd($insert);
        if($insert) {
            return redirect()->route('lessons.index')->with('status', 'Lesson Added');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Models\Location;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    protected $locationService;

    /** Injecting service class */
    public function __construct(LocationService $locationService){
        $this->locationService = $locationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->locationService->getAllLocation($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        try {
            $request->validate([
                'city' => 'required',
                'postcode' => 'required'
            ]);
           
            $this->locationService->addLocation($request->all());
            return redirect()->route('location.index')->with('status', 'Location Added!');
        } catch (Exceptions $ex) {
            Log::error('error while adding Location', $ex);
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
        try {
            $encodedData = decrypt($id);
            $locationData = Location::find($encodedData->id);
            
            return view('admin.location.edit', compact('locationData'));
        } catch (Exceptions $ex) {
            Log::error('error while fetching Location data for edit', $ex);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        try {
            $this->locationService->updateLocation($request->all(), $id);
            return redirect()->route('location.index')->with('status', 'Location Updated!');
        } catch (Exceptions $ex) {
            Log::error('error while updating Location', $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        
        //->with('lessonsLocation1')->first();
        
        if($location){
            return redirect()->route('location.index')->with('warning', 'Cant perform operation as Data is linked with other tables');
           
        } else {
            $location->delete();
            return redirect()->route('location.index')->with('status', 'Location deleted!');
        }
       
    }
}
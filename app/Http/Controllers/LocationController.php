<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Models\Location;

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
        $request->validate([
            'city' => 'required',
            'postcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $insert = $this->locationService->addLocation($request->all());
        if($insert) {
            return redirect()->route('location.index');
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
        $encodedData = decrypt($id);
        $locationData = Location::find($encodedData->id);
    
        return view('admin.location.edit', compact('locationData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =  $this->locationService->updateLocation($request->all(), $id);
        if($data){
          return redirect()->route('location.index')->with('status', 'Location Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id)->with('lessonsLocation')->get();
        
        if($location){
            return redirect()->route('location.index')->with('warning', 'Cant perform operation as Data is linked with other tables');
           
        } else {
            $location->delete();
            return redirect()->route('location.index')->with('status', 'Location deleted!');
        }
       
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PricingService;
use App\Models\Price;

class PricingController extends Controller
{

    protected $pricingService;

    /** Injecting service class */
    public function __construct(PricingService $pricingService){
        $this->pricingService = $pricingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->pricingService->getAllPrices($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pricing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hours' => 'required',
            'price' => 'required'
        ]);

        $insert = $this->pricingService->addPrice($request->all());
        if($insert) {
            return redirect()->route('price.index')->with('status', 'Price Added');
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
        $priceData = Price::find($encodedData->id);
    
        return view('admin.pricing.edit', compact('priceData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =  $this->pricingService->updatePrice($request->all(), $id);
        if($data){
          return redirect()->route('price.index')->with('status', 'Price Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

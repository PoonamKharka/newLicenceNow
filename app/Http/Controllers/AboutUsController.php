<?php

namespace App\Http\Controllers;

use App\Services\AboutUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Exceptions;

class AboutUsController extends Controller
{
    protected $abtUsService;

    /**
     * Create a new controller instance.
     */
    public function __construct(AboutUsService $aboutUsService)
    {
        return $this->abtUsService  = $aboutUsService;
    }

    /**
     * fetching index
     */
    public function index(Request $request) {
        return $this->abtUsService->getAboutList($request);
    }

    /**
     * display create about us form
     */
    public function create()
    {
        return $this->abtUsService->profile();
    }

    /**
     * display edit about us form with existing data
     */
    public function edit($id) {
        try {
            $editFormData = $this->abtUsService->editRecord($id);
            return view('admin.aboutus.edit', compact('editFormData'));
        } catch (Exceptions $ex) {
            Log::error('Error While fethcing Edit About Us Data:' , $ex);
        }
    }

    /**
     * Storing or updating about us data
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'page' => 'required|unique:aboutus',
                'description' => 'required',
            ]);
            
            $this->abtUsService->store($request);
            return redirect()->route('aboutus.index');
        } catch (Exceptions $ex) {
            Log::error('Error While Storing About Us Data:' , $ex);
        }
    }

    public function destroy($id) {
        try {
            $this->abtUsService->destroy($id);
            return redirect()->route('aboutus.index')->with('status', 'Operation has been performed!');
        } catch(Exceptions $ex){
            Log::error('Error While deleting About Us Data:' , $ex);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FaqContentService;
use Illuminate\Support\Exceptions;
use App\Models\FaqContent;

class FAQContentController extends Controller
{

    protected $faqContentService;

    /**
     * creating controller instance
     */
    public function __construct(FaqContentService $faqContentRepository)
    {
        return $this->faqContentService = $faqContentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = FaqContent::first();
        return view('admin.faqs.content.create', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $insert = $this->faqContentService->store($request->all());
            return redirect()->route('faqContent.index')->with('status', 'Data Added!');
        } catch(Exceptions $ex){
            Log::error('Error While Performing Action >> FaqContent:' , $ex);
        }
    }
}

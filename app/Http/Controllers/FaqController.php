<?php

namespace App\Http\Controllers;

use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        return $this->faqService = $faqService;
    }

    public function index(Request $request)
    {
        return $this->faqService->getAllFaqs($request);
    }

    public function create()
    {
        return  $this->faqService->profile();
 
    }

    public function store(Request $request)
    {
        return $this->faqService->store($request);
    }

    public function edit($id)
    {
        return $this->faqService->edit($id);
    }


}

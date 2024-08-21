<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    protected $regService;

    public function __construct(RegisterService $regService)
    {
        $this->regService = $regService;
    }

    public function index() {
        return $this->regService->index();
    }

    public function create() {
        return $this->regService->create();
    }
}

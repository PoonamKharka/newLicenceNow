<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface RegisterRepositoryInterFace {
    public function index(Request $request);
    public function create();
    public function store( Request $request );
    public function view($id);
}

?>
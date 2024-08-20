<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface LoginRepositoryInterFace {
    public function loginPage();
    public function postLogin( Request $request );
    public function logout();
}

?>
<?php

namespace App\Repositories\InterFaces;

use Illuminate\Http\Request;

interface ForgotPasswordRepositoryInterFace {
    public function showLinkRequestForm();
    public function sendResetLinkEmail( Request $request );
    public function showResetForm(Request $request, $token = null );
    public function reset(Request $request );
}

?>
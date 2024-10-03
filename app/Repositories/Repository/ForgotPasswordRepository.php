<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\ForgotPasswordRepositoryInterFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ForgotPasswordRepository implements ForgotPasswordRepositoryInterFace {

    
    /**
     * Display logi form of admin
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.forgot');

    }

    /**
     * for logging in
     *
     * @return \Illuminate\Http\Request
     */
    public function sendResetLinkEmail(Request $request)
    {       
       
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink($request->only('email'));
        
        Log::info('Reset status: ' . $status);
        
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        } elseif ($status === Password::RESET_THROTTLED) {
            return back()->withErrors(['email' => __($status)]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function showResetForm(Request $request, $token = null) 
    {
        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
        
    }

    /**
     * Reset the given user's password and log them in.
     *
     * @param  \App\Models\User  $user
     * 
    */
    public function reset(Request $request){
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $this->resetPassword($user, $password);
            }
        );
        
        return $status === Password::PASSWORD_RESET ? $this->sendResetResponse($request, $status): $this->sendResetFailedResponse($request, $status);
    }
    /**
     * Reset the given user's password and log them in.
     *
     * @param  \App\Models\User  $user
     * @param  string  $password
     * @return void
    */
    protected function resetPassword(User $user, string $password)
    {
       
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->email_verified_at = now();         
        $user->save();       
        $this->guard()->login($user);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('login')->with('status', __($response));
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return back()->withErrors(['email' => __($response)]);
    }
}

?>
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;
use Hash;

use App\User;

class AuthController extends Controller
{
    //use ThrottlesLogins;

     /**
     * @param Request $request
     * @return \Illuminate\Http\Response|void
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        //if ($this->hasTooManyLoginAttempts($request)) {
        //   return $this->sendLockoutResponse($request);
        //}

        return $this->attempLogin($request);

    }

    /**
     * @param Request $request
     */
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|void
     */
    protected function attempLogin(Request $request)
    {
        //$this->incrementLoginAttempts($request);
        //dd($request->email);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendFailedLoginResponse($request);
        }

        // 更新 api_key
        $api_token = uniqid($user->id);
        $user->api_token = $api_token;
        $user->save();

        return $this->sendLoginResponse($request, $user);
    }

    /**
     * @param Request $request
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request, User $user)
    {
        //$this->clearLoginAttempts($request);

        return \Response::make([
            'user' => $user,
            'token' => $user->api_token
        ]);
    }

    public function username()
    {
        return 'email';
    }

}

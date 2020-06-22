<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use Illuminate\Validation\ValidationException;
use Hash;

use App\User;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|void
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        return $this->attempLogin($request);
    }

    public function register(RegisterRequest $request)
    {
        $this->createUser($request);

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
     */
    public function validateRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|void
     */
    protected function attempLogin(Request $request)
    {
        $user = User::with('transporter')->where('email', $request->email)->first();

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

    public function createUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    
}

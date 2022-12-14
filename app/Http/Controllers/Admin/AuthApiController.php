<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{

    use ApiResponseTrait;
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $credentials = $request->only(['email','password']);
        if (! $token = Auth::attempt($credentials)) {
            return $this->apiResponse(400, 'User Not Found');
        }
        return $this->createToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->apiResponse(200, 'User Account Is Created', null, $user);
    }

    public function logout()
    {
        Auth::logout();
        return $this->apiResponse(200, 'User Logout Successfully');
    }

    public function userAccount()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return $this->apiResponse(200, 'User Account', null, $user);
    }

    public function refresh()
    {
        return $this->createToken(auth()->refresh());
    }

    private function createToken($token)
    {
        $array = [
            'access_token' => $token,
            'user' => auth()->user()
        ];
        return $this->apiResponse(200, 'User Login Successfully', null, $array);
    }

}

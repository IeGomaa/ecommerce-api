<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    use ApiResponseTrait;
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:clients,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $credentials = $request->only(['email','password']);
        if (! $token = Auth::guard('client_api')->attempt($credentials)) {
            return $this->apiResponse(400, 'Client Not Found');
        }
        return $this->createToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->apiResponse(200, 'Client Account Is Created', null, $client);
    }

    public function logout()
    {
        Auth::guard('client_api')->logout();
        return $this->apiResponse(200, 'Client Logout Successfully');
    }

    public function userAccount()
    {
        $user = Client::where('id', Auth::guard('client_api')->user()->id)->first();
        return $this->apiResponse(200, 'Client Account', null, $user);
    }

    public function refresh()
    {
        return $this->createToken(auth('client_api')->refresh());
    }

    private function createToken($token)
    {
        $array = [
            'access_token' => $token,
            'user' => auth('client_api')->user()
        ];
        return $this->apiResponse(200, 'Client Login Successfully', null, $array);
    }

}

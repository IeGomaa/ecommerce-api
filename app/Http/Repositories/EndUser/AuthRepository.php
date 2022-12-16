<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\AuthInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ClientTrait;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    private $clientModel;
    use ApiResponseTrait, ClientTrait;

    public function __construct(Client $client)
    {
        $this->clientModel = $client;
    }

    public function login($request)
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

    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $client = $this->clientModel::create([
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
        $user = $this->clientModel::where('id', Auth::guard('client_api')->user()->id)->first();
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

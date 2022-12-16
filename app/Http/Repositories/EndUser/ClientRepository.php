<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\ClientInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ClientTrait;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientRepository implements ClientInterface
{
    private $clientModel;
    use ApiResponseTrait,ClientTrait;

    public function __construct(Client $client)
    {
        $this->clientModel = $client;
    }

    public function index()
    {
        return $this->apiResponse(200, 'Client Account',null, auth('client_api')->user());
    }

    public function delete()
    {
        $this->clientItem(auth('client_api')->user()->id)->delete();
        return $this->apiResponse(200, 'Client Account Was Deleted');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'password' => 'string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $client = $this->clientModel;
        $client->update([
            'name' => ($request->name != null) ? $request->name : $client->name,
            'password' => ($request->password != null) ? Hash::make($request->password) : $client->password
        ]);
        return $this->apiResponse(200, 'Client Account Is Updated');
    }
}

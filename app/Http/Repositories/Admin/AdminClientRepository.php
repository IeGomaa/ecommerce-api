<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminClientInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ClientTrait;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class AdminClientRepository implements AdminClientInterface
{

    use ClientTrait,ApiResponseTrait;
    private $clientModel;
    public function __construct(Client $client)
    {
        $this->clientModel = $client;
    }

    public function index()
    {
        return $this->apiResponse(200, 'Client Data', null, $this->clients());
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:clients,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $this->clientItem($request->id)->delete();
        return $this->apiResponse(200, 'Client Was Deleted');
    }
}

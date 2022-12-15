<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ClientTrait;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminClientController extends Controller
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

    public function delete(Request $request)
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

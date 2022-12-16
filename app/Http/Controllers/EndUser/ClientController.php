<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\ClientInterface;

class ClientController extends Controller
{
    private $clientInterface;
    public function __construct(ClientInterface $interface)
    {
        $this->clientInterface = $interface;
    }

    public function index()
    {
        return $this->clientInterface->index();
    }

    public function delete()
    {
        return $this->clientInterface->delete();
    }

    public function update($request)
    {
        return $this->clientInterface->update($request);
    }
}

<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\OrderInterface;

class OrderController extends Controller
{
    private $orderInterface;
    public function __construct(OrderInterface $interface)
    {
        $this->orderInterface = $interface;
    }

    public function index()
    {
        return $this->orderInterface->index();
    }

    public function create($request)
    {
        return $this->orderInterface->create($request);
    }
}

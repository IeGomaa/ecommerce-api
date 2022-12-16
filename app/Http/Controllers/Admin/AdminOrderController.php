<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminOrderInterface;

class AdminOrderController extends Controller
{
    private $orderInterface;
    public function __construct(AdminOrderInterface $interface)
    {
        $this->orderInterface = $interface;
    }

    public function index()
    {
        return $this->orderInterface->index();
    }

    public function delete($request)
    {
        return $this->orderInterface->delete($request);
    }
}

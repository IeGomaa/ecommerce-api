<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminOrderInterface;
use Illuminate\Http\Request;

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

    public function delete(Request $request)
    {
        return $this->orderInterface->delete($request);
    }
}

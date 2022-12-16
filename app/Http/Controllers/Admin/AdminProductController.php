<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminProductInterface;

class AdminProductController extends Controller
{
    private $productInterface;
    public function __construct(AdminProductInterface $interface)
    {
        $this->productInterface = $interface;
    }

    public function index()
    {
        return $this->productInterface->index();
    }

    public function create($request)
    {
        return $this->productInterface->create($request);
    }

    public function delete($request)
    {
        return $this->productInterface->delete($request);
    }

    public function update($request)
    {
        return $this->productInterface->update($request);
    }
}

<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\ProductInterface;

class ProductController extends Controller
{
    private $productInterface;
    public function __construct(ProductInterface $interface)
    {
        $this->productInterface = $interface;
    }

    public function index()
    {
        return $this->productInterface->index();
    }
}

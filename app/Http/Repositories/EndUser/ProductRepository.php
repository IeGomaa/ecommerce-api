<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\ProductInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ProductTrait;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    private $productModel;
    use ApiResponseTrait, ProductTrait;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index()
    {
        $products = $this->products();
        return $this->apiResponse(200, 'Products Data', null, $products);
    }
}

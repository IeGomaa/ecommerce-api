<?php

namespace App\Http\Traits;

trait ProductTrait
{
    private function productItem($id)
    {
        return $this->productModel::find($id);
    }

    private function products()
    {
        return $this->productModel::get();
    }
}

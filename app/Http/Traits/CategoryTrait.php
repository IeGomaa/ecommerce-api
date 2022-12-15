<?php

namespace App\Http\Traits;

trait CategoryTrait
{
    private function categoryItem($id)
    {
        return $this->categoryModel::find($id);
    }

    private function categories()
    {
        return $this->categoryModel::get();
    }
}

<?php

namespace App\Http\Traits;

trait OrderTrait
{
    private function orderItem($id)
    {
        return $this->orderModel::find($id);
    }

    private function orders()
    {
        return $this->orderModel::get();
    }
}

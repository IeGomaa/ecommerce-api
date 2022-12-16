<?php

namespace App\Http\Traits;

use App\Models\Cart;

trait CartTrait
{
    private function cartItem($id)
    {
        return Cart::where('client_id',$id)->get();
    }

}

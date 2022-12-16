<?php

namespace App\Rules\EndUser\Order;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;

class CartCountValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cartItems = Cart::where('client_id', auth('client_api')->user()->id)->with('product')->get();
        if (count($cartItems) != 0) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cart Was Empty Sr.';
    }
}

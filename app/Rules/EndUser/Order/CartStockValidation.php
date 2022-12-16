<?php

namespace App\Rules\EndUser\Order;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;

class CartStockValidation implements Rule
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
        if ($cartItems) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem->count > $cartItem->product->stock)
                    return false;
            }
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry The Count Not Available';
    }
}

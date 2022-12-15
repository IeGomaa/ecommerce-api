<?php

namespace App\Rules\EndUser\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class StockValidation implements Rule
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
        return Product::where([
            ['id',request('product_id')],
            ['stock', '>=', $value]
        ])->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry The Count Of Product Less Than';
    }
}

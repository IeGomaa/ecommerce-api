<?php

namespace App\Observers;

use App\Http\Traits\Api\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderObserver
{
    use ApiResponseTrait;
    public function created(Order $order)
    {
        $cartItems = Cart::where('client_id', auth('client_api')->user()->id)->with('product')->get();
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'count' => $cartItem->count,
                'unit_price' => $cartItem->product->price,
                'total_price' => $cartItem->count * $cartItem->product->price,
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id
            ]);

            $product = Product::find($cartItem->product_id);
            $product->update([
                'stock' => $product->stock - $cartItem->count,
            ]);
            $cartItem->delete();
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}

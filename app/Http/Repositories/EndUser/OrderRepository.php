<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\OrderInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Rules\EndUser\Order\CartCountValidation;
use App\Rules\EndUser\Order\CartStockValidation;
use Illuminate\Support\Facades\Validator;

class OrderRepository implements OrderInterface
{
    use ApiResponseTrait;
    public function index()
    {
        $order = Order::where('client_id',auth('client_api')->user()->id)->first();
        return $this->apiResponse(200, 'Order Data',null,$order);
    }

    public function create($request)
    {
        $validator = Validator::make($request->header(), [
            'authorization' => [new CartCountValidation(), new CartStockValidation()]
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(401, 'Validation Error', $validator->errors());
        }

        $cartItems = Cart::where('client_id', auth('client_api')->user()->id)->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->count * $item->product->price;
        });

        Order::create([
            'client_id' => auth('client_api')->user()->id,
            'total_price' => $totalPrice
        ]);
        return $this->apiResponse(200, 'Order Was Created');
    }
}

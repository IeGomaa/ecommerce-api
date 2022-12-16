<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\CartInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\CartTrait;
use App\Models\Cart;
use App\Rules\EndUser\Cart\CountValidation;
use App\Rules\EndUser\Cart\StockValidation;
use Illuminate\Support\Facades\Validator;

class CartRepository implements CartInterface
{
    private $cartModel;
    use ApiResponseTrait,CartTrait;
    public function __construct(Cart $cart)
    {
        $this->cartModel = $cart;
    }

    public function clientCart()
    {
        $cart = $this->cartItem(auth('client_api')->user()->id);
        return $this->apiResponse(200, 'Cart Data',null, $cart);
    }

    public function addToCart($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new CountValidation(), new StockValidation()]
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $client_id = auth('client_api')->user()->id;
        $cart = $this->cartModel::where([ ['client_id', $client_id],['product_id',$request->product_id] ])->first();

        if ($cart) {
            $cart->update([
                'count' => ($cart->count + $request->count)
            ]);
            return $this->apiResponse(200, 'Cart Is Updated');

        } else {
            $cart = $this->cartModel::create([
                'client_id' => $client_id,
                'product_id' => $request->product_id,
                'count' => $request->count
            ]);
            return $this->apiResponse(200, 'Cart Is Created', null,$cart);
        }
    }

    public function deleteFromCart($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $client_id = auth('client_api')->user()->id;
        $cart = $this->cartModel::where([ ['client_id', $client_id],['product_id',$request->product_id] ])->first();

        if ($cart) {
            $cart->delete();
            return $this->apiResponse(200, 'Product Is Deleted');
        }
        return $this->apiResponse(400, 'You Don\'t Have This Product Sr');
    }

    public function deleteCart()
    {
        $productsInCart = $this->cartItem(auth('client_api')->user()->id);
        foreach ($productsInCart as $productInCart)
            $this->cartModel::find($productInCart->id)->delete();
        return $this->apiResponse(200, 'Cart Is Deleted');
    }

    public function updateCount($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new StockValidation()]
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }
        $client_id = auth('client_api')->user()->id;
        $cart = $this->cartModel::where([ ['client_id', $client_id],['product_id',$request->product_id] ])->first();

        $cart->update([
            'count' => $request->count
        ]);
        return $this->apiResponse(200, 'Cart Is Updated');
    }
}

<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\CartInterface;

class CartController extends Controller
{
    private $cartInterface;
    public function __construct(CartInterface $interface)
    {
        $this->cartInterface = $interface;
    }

    public function clientCart()
    {
        return $this->cartInterface->clientCart();
    }

    public function addToCart($request)
    {
        return $this->cartInterface->addToCart($request);
    }

    public function deleteFromCart($request)
    {
        return $this->cartInterface->deleteFromCart($request);
    }

    public function deleteCart()
    {
        return $this->cartInterface->deleteCart();
    }

    public function updateCount($request)
    {
        return $this->cartInterface->updateCount($request);
    }
}

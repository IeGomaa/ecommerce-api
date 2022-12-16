<?php

namespace App\Http\Interfaces\EndUser;

interface CartInterface
{
    public function clientCart();
    public function addToCart($request);
    public function deleteFromCart($request);
    public function deleteCart();
    public function updateCount($request);
}

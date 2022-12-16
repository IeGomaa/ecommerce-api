<?php

namespace App\Http\Interfaces\EndUser;

interface OrderInterface
{
    public function index();
    public function create($request);
}

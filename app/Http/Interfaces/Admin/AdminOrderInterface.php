<?php

namespace App\Http\Interfaces\Admin;

interface AdminOrderInterface
{
    public function index();
    public function delete($request);
}

<?php

namespace App\Http\Interfaces\Admin;

interface AdminAuthInterface
{
    public function login($request);
    public function register($request);
    public function logout();
    public function userAccount();
    public function refresh();
}

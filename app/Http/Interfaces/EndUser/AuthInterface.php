<?php

namespace App\Http\Interfaces\EndUser;

interface AuthInterface
{
    public function login($request);
    public function register($request);
    public function logout();
    public function userAccount();
    public function refresh();
}

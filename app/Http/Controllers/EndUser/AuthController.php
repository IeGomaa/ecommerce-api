<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authController;
    public function __construct(AuthInterface $interface)
    {
        $this->authController = $interface;
    }

    public function login(Request $request)
    {
        return $this->authController->login($request);
    }

    public function register(Request $request)
    {
        return $this->authController->register($request);
    }

    public function logout()
    {
        return $this->authController->logout();
    }

    public function userAccount()
    {
        return $this->authController->userAccount();
    }

    public function refresh()
    {
        return $this->authController->refresh();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminAuthInterface;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private $authInterface;
    public function __construct(AdminAuthInterface $interface)
    {
        $this->authInterface = $interface;
    }

    public function login(Request $request)
    {
        return $this->authInterface->login($request);
    }

    public function register(Request $request)
    {
        return $this->authInterface->register($request);
    }

    public function logout()
    {
        return $this->authInterface->logout();
    }

    public function userAccount()
    {
        return $this->authInterface->userAccount();
    }

    public function refresh()
    {
        return $this->authInterface->refresh();
    }
}

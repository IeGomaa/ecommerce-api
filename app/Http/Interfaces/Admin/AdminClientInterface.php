<?php

namespace App\Http\Interfaces\Admin;

interface AdminClientInterface
{
    public function index();
    public function delete($request);
}

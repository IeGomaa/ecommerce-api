<?php

namespace App\Http\Interfaces\EndUser;

interface ClientInterface
{
    public function index();
    public function delete();
    public function update($request);
}

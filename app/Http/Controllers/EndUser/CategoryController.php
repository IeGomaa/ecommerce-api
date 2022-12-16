<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\CategoryInterface;

class CategoryController extends Controller
{
    private $categoryInterface;
    public function __construct(CategoryInterface $interface)
    {
        $this->categoryInterface = $interface;
    }

    public function index()
    {
        return $this->categoryInterface->index();
    }
}

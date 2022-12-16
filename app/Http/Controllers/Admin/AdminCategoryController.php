<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminCategoryInterface;

class AdminCategoryController extends Controller
{
    private $categoryInterface;
    public function __construct(AdminCategoryInterface $interface)
    {
        $this->categoryInterface = $interface;
    }

    public function index()
    {
        return $this->categoryInterface->index();
    }

    public function create($request)
    {
        return $this->categoryInterface->create($request);
    }

    public function delete($request)
    {
        return $this->categoryInterface->delete($request);
    }

    public function update($request)
    {
        return $this->categoryInterface->update($request);
    }
}

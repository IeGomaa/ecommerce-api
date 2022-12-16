<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminCategoryInterface;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        return $this->categoryInterface->create($request);
    }

    public function delete(Request $request)
    {
        return $this->categoryInterface->delete($request);
    }

    public function update(Request $request)
    {
        return $this->categoryInterface->update($request);
    }
}

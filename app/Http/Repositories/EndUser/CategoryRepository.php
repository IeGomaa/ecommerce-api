<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\CategoryInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    private $categoryModel;
    use ApiResponseTrait, CategoryTrait;
    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = $this->categories();
        return $this->apiResponse(200, 'Categories Data', null, $categories);
    }
}

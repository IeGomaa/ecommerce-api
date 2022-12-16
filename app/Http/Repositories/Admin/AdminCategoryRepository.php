<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminCategoryInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class AdminCategoryRepository implements AdminCategoryInterface
{
    use CategoryTrait,ApiResponseTrait;
    private $categoryModel;
    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        return $this->apiResponse(200, 'Category Data', null, $this->categories());
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $category = $this->categoryModel::create([
            'name' => $request->name
        ]);
        return $this->apiResponse(200, 'Category Was Created', null, $category);
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $this->categoryItem($request->id)->delete();
        return $this->apiResponse(200, 'Category Was Deleted');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id',
            'name' => 'required|unique:categories,name,' . $request->id
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $this->categoryItem($request->id)->update([
            'name' => $request->name
        ]);
        return $this->apiResponse(200, 'Category Was Update');
    }

}

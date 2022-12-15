<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ProductTrait;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    use ProductTrait,ApiResponseTrait;
    private $productModel;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index()
    {
        return $this->apiResponse(200, 'Product Data', null, $this->products());
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products,name',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $product = $this->productModel::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);
        return $this->apiResponse(200, 'Product Was Created', null, $product);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $this->productItem($request->id)->delete();
        return $this->apiResponse(200, 'Product Was Deleted');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'price' => 'required',
            'stock' => 'required',
            'name' => 'string|unique:products,name,' . $request->id,
            'category_id' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $product = $this->productItem($request->id);

        $product->update([
            'price' => $request->price,
            'stock' => $request->stock,
            'name' => ($request->name != null) ? $request->name : $product->name,
            'category_id' => ($request->category_id != null) ? $request->category_id : $product->category_id
        ]);
        return $this->apiResponse(200, 'Category Was Update');
    }
}

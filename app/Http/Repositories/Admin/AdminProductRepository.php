<?php

namespace App\Http\Repositories\Admin;

use App\Exports\ProductsExport;
use App\Http\Interfaces\Admin\AdminProductInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\ProductTrait;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminProductRepository implements AdminProductInterface
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

    public function create($request)
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

    public function import($request)
    {
        $validator = Validator::make($request->all(), [
            'excel' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        Excel::import(new ProductImport, $request->excel);
        return $this->apiResponse(200, 'Products Was Created');
    }

    public function exportDummyData()
    {
        return Excel::download(new ProductsExport, 'test.xlsx');
    }

    public function delete($request)
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

    public function update($request)
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

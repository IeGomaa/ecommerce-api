<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminOrderInterface;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Http\Traits\OrderTrait;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class AdminOrderRepository implements AdminOrderInterface
{
    use OrderTrait,ApiResponseTrait;
    private $orderModel;
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }

    public function index()
    {
        return $this->apiResponse(200, 'Order Data', null, $this->orders());
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', $validator->errors());
        }

        $this->orderItem($request->id)->delete();
        return $this->apiResponse(200, 'Order Was Deleted');
    }
}

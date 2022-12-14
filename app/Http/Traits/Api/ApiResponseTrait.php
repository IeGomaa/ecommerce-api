<?php

namespace App\Http\Traits\Api;

use function response;

trait ApiResponseTrait
{
    private function apiResponse($code = 200, $message = null, $errors = null, $data = null)
    {
        $array = [
            'status' => $code,
            'message' => $message
        ];

        if (is_null($data) && !is_null($errors)) {
            $array['errors'] = $errors;
        } elseif (is_null($errors) && !is_null($data)) {
            $array['data'] = $data;
        } else {
            $array['errors'] = $errors;
            $array['data'] = $data;
        }

        return response($array, 200);
    }
}

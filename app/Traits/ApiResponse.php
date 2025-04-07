<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null, int $code = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);  
    }   

    protected function errorResponse($message = null, int $code = 400, $errors = null)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}

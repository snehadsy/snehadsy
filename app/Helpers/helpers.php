<?php

if (!function_exists('successResponse')) {
    function successResponse(
        $statusCode = 200,
        $message = '',
        $data = null
    ) {
        return response()->json([
            'status' => 'success',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse(
        $statusCode = 500,
        $message = 'Something went Wrong',
        $data = null
    ) {
        return response()->json([
            'status' => 'error',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
<?php

namespace App\Traits;

trait ApiResponsesTrait {
    protected function apiSuccessResponse($data, $message = 'Request processed successfully', $status = 200) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }
}

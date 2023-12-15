<?php
class Responses {
    public static function success($message, $data = null, $statusCode = 200) {
        return response()->json([
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data,
        ], $statusCode);
    }
    public static function error($message, $statusCode = 400) {
        return response()->json([
            'message' => $message,
            'statusCode' => $statusCode,
        ], $statusCode);
    }
}

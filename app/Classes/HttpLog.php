<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class HttpLog extends Log {
    public function logInfo($request) {
        $data = file_get_contents('php://input');
        Log::info("Data:\n" . $data);
        Log::info('Method: ' . $request->method());
        Log::info('Headers: ', $request->headers->all());
        Log::info('Content-Type: ' . $request->header('Content-Type'));
    }
}

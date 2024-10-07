<?php

namespace Muneebkh2\LaravelFcmNotifications\Utility;


use Illuminate\Http\Client\Response;

class FCMErrorHandler
{
    /**
     * @throws \Exception
     */
    public static function handleError(Response $response): void
    {
        $statusCode = $response->status();
        $errorBody = $response->json();

        throw match ($statusCode) {
            401 => new \Exception('Unauthorized: Invalid or expired token. ' . ($errorBody['error']['message'] ?? '')),
            404 => new \Exception('Invalid token: Device token is not registered. ' . ($errorBody['error']['message'] ?? '')),
            429 => new \Exception('Quota exceeded: Too many requests.'),
            500, 503 => new \Exception('FCM server error. Try again later.'),
            default => new \Exception("Unknown error occurred. Status Code: {$statusCode}. Error: " . ($errorBody['error']['message'] ?? '')),
        };
    }
}

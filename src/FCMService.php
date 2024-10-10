<?php

namespace Muneebkh2\LaravelFcmNotifications;

use Illuminate\Support\Facades\Http;
use Muneebkh2\LaravelFcmNotifications\Utility\FCMConfig;
use Muneebkh2\LaravelFcmNotifications\Utility\FCMTokenService;
use Muneebkh2\LaravelFcmNotifications\Utility\FCMErrorHandler;
use Muneebkh2\LaravelFcmNotifications\Utility\FCMRequestBodyBuilder;

class FCMService
{
    private FCMConfig $FCMConfig;
    private FCMTokenService $FCMTokenService;
    private FCMRequestBodyBuilder $FCMRequestBuilder;

    public function __construct(
    ){
        $this->FCMConfig = new FCMConfig();
        $this->FCMTokenService = new FCMTokenService();
        $this->FCMRequestBuilder = new FCMRequestBodyBuilder();
    }

    /**
     * @throws \Exception
     */
    public function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $url = $this->FCMConfig->getFCMUrl();
        $accessToken = $this->FCMTokenService->getAccessToken();
        $requestBody = $this->FCMRequestBuilder->setDeviceToken($deviceToken)->setNotification($title, $body)->setNotificationData($data)->build();

        $response = Http::withToken($accessToken)
            ->post($url, $requestBody);

        if ($response->failed() || $response->status() !== 200) {
            FCMErrorHandler::handleError($response);
        }

        return $response->json();
    }
}

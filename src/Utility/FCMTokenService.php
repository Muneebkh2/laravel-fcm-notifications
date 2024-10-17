<?php

namespace Muneebkh2\LaravelFcmNotifications\Utility;

use Illuminate\Support\Facades\Log;
use Google\Auth\Credentials\ServiceAccountCredentials;

class FCMTokenService
{
    private string $accessToken;
    private static ?FCMTokenService $instance = null;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->accessToken = $this->generateAccessToken();
    }

    public static function getInstance(): FCMTokenService
    {
        if (self::$instance === null) {
            self::$instance = new FCMTokenService();
        }
        return self::$instance;
    }

    /**
     * @throws \Exception
     */
    private function generateAccessToken(): string
    {
        $config = new FCMConfig();
        Log::debug('FCM config file path', ['path' => $config->getCredentialsFile(), 'base_path' => base_path($config->getCredentialsFile())])
        $credentials = new ServiceAccountCredentials(
            $config->getScopes(),
            base_path($config->getCredentialsFile())
        );
        $authToken = $credentials->fetchAuthToken();

        if (!isset($authToken['access_token'])) {
            throw new \Exception("Failed to generate access token.");
        }

        return $authToken['access_token'];
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}

<?php

namespace Muneebkh2\LaravelFcmNotifications\Utility;

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
        $credentials = new ServiceAccountCredentials(
            $config->getScopes(),
            $config->getCredentialsFile()
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

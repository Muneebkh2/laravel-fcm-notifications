<?php

namespace Muneebkh2\LaravelFcmNotifications\Utility;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class FCMConfig
{
    /**
     * @var Repository|Application|mixed
     */
    private mixed $projectId;
    /**
     * @var Repository|Application|mixed
     */
    private mixed $credentialsFile;
    /**
     * @var array|string[]
     */
    private array $scopes;

    public function __construct()
    {
        $this->projectId = config('fcm.project_id');
        $this->credentialsFile = config('fcm.credentials.file');
        $this->scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function getCredentialsFile()
    {
        return $this->credentialsFile;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getFCMUrl(): string
    {
        return 'https://fcm.googleapis.com/v1/projects/' . $this->projectId . '/messages:send';
    }
}

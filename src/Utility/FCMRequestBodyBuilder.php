<?php

namespace Muneebkh2\LaravelFcmNotifications\Utility;

class FCMRequestBodyBuilder
{
    private array $message;

    public function __construct()
    {
        $this->message = [];
    }

    public function setDeviceToken(string $deviceToken): self
    {
        $this->message['token'] = $deviceToken;
        return $this;
    }

    public function setNotification(string $title, string $body): self
    {
        $this->message['notification']['body'] = $body;
        $this->message['notification']['title'] = $title;
        return $this;
    }

    public function build(): array
    {
        return ['message' => $this->message];
    }
}

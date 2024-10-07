# Laravel FCM Notifications

A Laravel package for sending push notifications using Firebase Cloud Messaging (FCM).

## Installation

You can install the package via Composer:

```bash
composer require muneebkh2/laravel-fcm-notifications
```

### Publish the Configuration
The configuration file will be automatically published. If you need to manually publish it, you can run:
```bash
php artisan vendor:publish --provider="Muneebkh2\LaravelFcmNotifications\FCMServiceProvider" --tag="config"
```

### Configuration
Add your Firebase credentials and project ID to the .env file:
```dotenv
FIREBASE_CREDENTIALS=/path/to/your/firebase_credentials.json
FIREBASE_PROJECT_ID=your-firebase-project-id
```

### Usage
You can use the FCM facade to send notifications. Here’s an example:
```php
<php

use Muneebkh2\LaravelFcmNotifications\Facades\LaravelFCM;

LaravelFCM::sendNotification($deviceToken, 'Test Title', 'Test Body');

```


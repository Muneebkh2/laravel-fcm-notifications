<?php

namespace Muneebkh2\LaravelFcmNotifications;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class FCMServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fcm.php', 'fcm');

        $this->app->singleton(FCMService::class, function ($app) {
            return new FCMService();
        });
    }

    public function boot(Filesystem $filesystem)
    {
        $configPath = config_path('fcm.php');
        $sourcePath = __DIR__.'/../config/fcm.php';

        // Automatically publish the configuration file if it doesn't exist
        if ($this->app->runningInConsole()) {
            if (!$filesystem->exists($configPath)) {
                $filesystem->copy($sourcePath, $configPath);
            } else {
                // Optionally, update the existing config file
                $this->updateConfigFile($filesystem, $sourcePath, $configPath);
            }
        }
    }

    protected function updateConfigFile(Filesystem $filesystem, $sourcePath, $configPath)
    {
        // Logic to update the existing config file
        // For example, you could merge new keys or overwrite existing ones
        $sourceConfig = $filesystem->get($sourcePath);
        $existingConfig = $filesystem->get($configPath);

        // Simple example: overwrite the existing config file
        $filesystem->put($configPath, $sourceConfig);
    }}

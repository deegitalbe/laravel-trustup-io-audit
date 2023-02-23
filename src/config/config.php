<?php

use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;

return [
    'adapter' => LogServiceAdapter::class,
    'app_key' => env("TRUSTUP_APP_KEY"),
];

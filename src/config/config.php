<?php

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

return [
    'adapter' => LogServiceAdapterContract::class,
    'app_key' => env("TRUSTUP_APP_KEY"),
];

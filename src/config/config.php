<?php

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

return [
    /** your adapter should implement LogAdapterContract */
    'adapter' => LogServiceAdapterContract::class,
    'app_key' => env("TRUSTUP_APP_KEY"),
    // 'enabled' => env("TRUSTUP_IO_AUDIT_LOG_ENABLED", true),
];

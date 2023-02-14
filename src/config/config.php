<?php

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

return [
    /** your adapter should implement LogAdapterContract */
    'adapter' => LogServiceAdapterContract::class,
    'app_key' => env("TRUSTUP_APP_KEY"),
    'app_env' => env("APP_ENV"),
    'audit_log_enabled' => env("AUDIT_LOG_ENABLED")


];

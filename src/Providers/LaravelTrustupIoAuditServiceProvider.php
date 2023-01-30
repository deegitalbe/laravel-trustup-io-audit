<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Providers;

use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreRequest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Models\Log;
use Deegitalbe\LaravelTrustupIoAudit\Package;
use Deegitalbe\LaravelTrustupIoProjects\Api\Endpoints\LogEndpoint;
use Deegitalbe\LaravelTrustupIoProjects\Contracts\Api\Endpoints\LogEndpointContract;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;

class LaravelTrustupIoAuditServiceProvider extends VersionablePackageServiceProvider
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }

    protected function addToRegister(): void
    {
        $this->app->bind(LogEndpointContract::class, LogEndpoint::class);
        $this->app->bind(StoreRequestContract::class, StoreRequest::class);
        $this->app->bind(StoreResponseContract::class, StoreResponse::class);
        $this->app->bind(LogContract::class, Log::class);
    }

    protected function addToBoot(): void
    {
        //
    }
}

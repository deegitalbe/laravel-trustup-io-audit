<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Providers;

use Deegitalbe\LaravelTrustupIoAudit\Package;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\StoreLogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogResponseContract;
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
        $this->app->bind(StoreLogResponseContract::class, StoreLogResponse::class);
    }

    protected function addToBoot(): void
    {
        //
    }
}

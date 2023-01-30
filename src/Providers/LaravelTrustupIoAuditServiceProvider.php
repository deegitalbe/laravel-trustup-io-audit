<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Providers;

use Deegitalbe\LaravelTrustupIoAudit\Package;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
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
    }

    protected function addToBoot(): void
    {
        //
    }
}

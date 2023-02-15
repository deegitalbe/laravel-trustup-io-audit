<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Providers;

use Deegitalbe\LaravelTrustupIoAudit\Models\Log;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\LogResponse;
use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit as PackageClass;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\IndexLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\IndexLogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\StoreLogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\LogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

class LaravelTrustupIoAuditServiceProvider extends VersionablePackageServiceProvider
{

    public static function getPackageClass(): string
    {
        return PackageClass::class;
    }

    protected function addToRegister(): void
    {
        $this->app->bind(LogEndpointContract::class, LogEndpoint::class);
        $this->app->bind(StoreLogResponseContract::class, StoreLogResponse::class);
        $this->app->bind(StoreLogRequestContract::class, StoreLogRequest::class);
        $this->app->bind(LogServiceAdapterContract::class, LogServiceAdapter::class);
        $this->app->bind(LogServiceContract::class, LogService::class);
        $this->app->bind(LogContract::class, Log::class);
        $this->app->bind(IndexLogRequestContract::class, IndexLogRequest::class);
        $this->app->bind(IndexLogResponseContract::class, IndexLogResponse::class);
        $this->app->bind(LogResponseContract::class, LogResponse::class);
        $this->app->bind(LogStatusContrat::class, LogStatus::class);
    }

    protected function addToBoot(): void
    {
    }
}

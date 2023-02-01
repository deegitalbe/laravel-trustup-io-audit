<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Providers;

use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Deegitalbe\LaravelTrustupIoAudit\Package as PackageClass;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\StoreLogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;

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
		$this->app->bind(LogService::class, LogServiceContract::class);
		$this->app->bind(LogServiceAdapter::class, Package::getConfig('adapter'));
	}

	protected function addToBoot(): void
	{
	}
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts;

use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\Contracts\VersionablePackageContract;
use Henrotaym\LaravelContainerAutoRegister\Services\AutoRegister\Contracts\AutoRegistrableContract;

/**
 * Versioning package.
 */
interface TrustupIoAuditContract extends VersionablePackageContract, AutoRegistrableContract
{
    public function mock(): MockInterface;

    public function disable(): void;

    public function enable(): void;

    public function storeAttributes(string $eventName, array $attributes): ?string;

    // dispatch job that triggers endpoint.
    public function storeRequest(StoreLogRequestContract $request): ?string;

    /** return url from env */
    public function getApiUrl(): string;
}

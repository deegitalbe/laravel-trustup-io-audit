<?php
namespace Deegitalbe\LaravelTrustupIoAudit;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\TrustupIoAuditContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;
use Mockery\MockInterface;

class TrustupIoAudit extends VersionablePackage implements TrustupIoAuditContract
{
    public static function prefix(): string
    {
        return "laravel-trustup-io-audit";
    }

    public function mock(): MockInterface
    {
        
    }

    public function disable(): void
    {
        
    }

    public function enable(): void
    {
        
    }

    public function storeAttributes(string $eventName, array $attributes): ?string
    {
        
    }

    public function storeRequest(StoreLogRequestContract $request): ?string
    {
        
    }
}
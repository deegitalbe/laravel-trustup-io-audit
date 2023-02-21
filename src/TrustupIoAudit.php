<?php

namespace Deegitalbe\LaravelTrustupIoAudit;

use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\TrustupIoAuditContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;

class TrustupIoAudit extends VersionablePackage implements TrustupIoAuditContract
{
    public function __construct(
        protected LogStatusContract $logStatus,
        protected LogServiceContract $logService
    ){
        $this->logStatus = $logStatus;
        $this->logService = $logService;
    }

    public static function prefix(): string
    {
        return "laravel-trustup-io-audit";
    }

    public function mock(): MockInterface
    {
        return $this->logStatus->mock();
    }

    public function disable(): void
    {
        $this->logStatus->disable();
    }

    public function enable(): void
    {
        $this->logStatus->enable();
    }

    public function storeAttributes(string $eventName, array $attributes): ?string
    {
        return $this->logService->storeAttributes($eventName, $attributes);
    }

    public function storeRequest(StoreLogRequestContract $request): ?string
    {
        return $this->logService->storeRequest($request);
    }

    public function getUrl(): string
    {
        if (app()->environment('TRUSTUP_IO_AUDIT_URL')) return app()->environment('TRUSTUP_IO_AUDIT_URL');
        if ($this->getEnv() === "staging") return  "staging-trustup-io-audit";
        if ($this->getEnv() === "local") return  "trustup-io-audit";
        if ($this->getEnv() === "testing") return  "trustup-io-audit";
        if ($this->getEnv() === "production") return  "production-staging-trustup-io-audit";
    }

    protected function getEnv(): string
    {
        return app()->environment();
    }
}

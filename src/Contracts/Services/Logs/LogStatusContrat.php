<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs;

use Mockery\MockInterface;

interface LogStatusContrat
{
    // public function getProductionUrl(): string;

    // public function getStagingUrl(): string;

    // public function getAppEnv(): string;

    // public function getAuditLogEnvStatus(): string;

    // public function isRunningTest(): bool;

    public function enable(): void;

    public function disable(): void;

    public function isDisabled(): bool;

    public function isEnabled(): bool;

    /**
     * @return MockInterface|LogServiceContract
     */
    public function mock(): MockInterface;

    // public function getAppUrl(): string;
}

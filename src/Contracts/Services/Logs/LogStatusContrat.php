<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs;

use Mockery\MockInterface;

interface LogStatusContrat
{
    public function enable(): void;

    public function disable(): void;

    public function isDisabled(): bool;

    /**
     * Verify if audit log is enabled
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @return MockInterface|LogServiceContract
     */
    public function mock(): MockInterface;
}

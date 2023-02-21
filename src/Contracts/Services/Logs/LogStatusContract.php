<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs;

use Mockery\MockInterface;

interface LogStatusContract
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

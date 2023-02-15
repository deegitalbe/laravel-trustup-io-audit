<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Mockery;
use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;

class LogStatus implements LogStatusContrat
{
    protected static bool $isEnabled = true;
    protected static bool $isEnabledInTests = false;

    /**
     * Enable mock
     */
    public function mock(): MockInterface
    {
        self::$isEnabledInTests = true;

        return app()->instance(
            LogServiceContract::class,
            Mockery::mock(LogServiceContract::class, function (MockInterface $mock) {
                return $mock;
            })
        );
    }

    public function getAppEnv(): string
    {
        return app()->environment();
    }

    public function enable(): void
    {
        $this->setIsEnabled(true);
    }

    public function disable(): void
    {
        $this->setIsEnabled(false);
    }

    protected function setIsEnabled(bool $isEnabled): self
    {
        self::$isEnabled = $isEnabled;

        return $this;
    }

    public function isEnabled(): bool
    {
        if (!self::$isEnabled) return false;
        if (app()->runningUnitTests() && !self::$isEnabledInTests) return false;
        return true;
    }

    public function isDisabled(): bool
    {
        return !$this->isEnabled();
    }
}

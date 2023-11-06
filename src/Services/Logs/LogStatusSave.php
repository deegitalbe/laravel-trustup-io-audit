<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Mockery;
use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;

class LogStatusSave implements LogStatusContract
{
    protected static bool $isEnabled = true;
    protected static bool $isEnabledInTests = false;

    /**
     * Mocking LogStatusCOntract.
     *
     * @return LogServiceContract|MockInterface
     */

    public function mock(): MockInterface
    {
        $this->setIsEnableInTests(true);
        /** @var MockInterface */
        $mock = Mockery::mock(LogServiceContract::class);

        app()->singleton(LogServiceContract::class, function ($app) use ($mock) {
            return $mock;
        });

        return $mock;
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

    protected function setIsEnableInTests(bool $isEnabledInTests): self
    {
        self::$isEnabledInTests = $isEnabledInTests;
        return $this;
    }
}

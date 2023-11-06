<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Mockery;
use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Illuminate\Support\Facades\Log;

class LogStatus implements LogStatusContract
{
    protected bool $isEnabled = true;
    protected bool $isEnabledInTests = false;

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
        app()->singleton(LogServiceContract::class, fn () => $mock);

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
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function isEnabled(): bool
    {
        if (!$this->isEnabled) return false;
        if (app()->runningUnitTests() && !$this->isEnabledInTests) return false;
        return true;
    }

    public function isDisabled(): bool
    {
        return !$this->isEnabled();
    }

    protected function setIsEnableInTests(bool $isEnabledInTests): self
    {
        $this->isEnabledInTests = $isEnabledInTests;
        return $this;
    }
}

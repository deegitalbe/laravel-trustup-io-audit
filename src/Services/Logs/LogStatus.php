<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Mockery;
use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;

class LogStatus implements LogStatusContrat
{
    protected static bool $isEnabled = true;
    protected static bool $isEnabledInTests = false;

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

    // protected function isEnabledInEnvironment()
    // {
    //     return env("TRUSTUP_IO_AUDIT_LOG_ENABLED", true);
    // }

    // public function getAuditLogEnvStatus(): string
    // {
    //     return Package::getConfig("audit_log_enabled");
    // }

    // public function getProductionUrl(): string
    // {
    //     return  Package::getConfig("trustpup_io_audit_url");
    // }

    // public function getStagingUrl(): string
    // {
    //     return Package::getConfig("trustpup_io_audit_url_staging");
    // }

    // public function isRunningTest(): bool
    // {
    //     return  app()->runningUnitTests();
    // }

    // public function shouldNotLogEvent(): bool
    // {
    //     if ($this->validateAsBool($this->getAuditLogEnvStatus()) === true) return false;
    //     return true;
    // }

    // public function disabled(): bool
    // {
    //     if ($this->isRunningTest()) return true;
    //     if ($this->shouldNotLogEvent()) return true;
    //     return false;
    // }

    // public function getAppUrl(): string
    // {
    //     if (!$this->getAppEnv() === "staging") return $this->getProductionUrl();
    //     return $this->getStagingUrl();
    // }

    // protected function validateAsBool(string $string): bool
    // {
    //     return filter_var($string, FILTER_VALIDATE_BOOLEAN);
    // }
}

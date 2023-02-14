<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;

class LogStatus implements LogStatusContrat
{
    public function getAppEnv(): string
    {
        return Package::getConfig("app_env");
    }

    public function getAuditLogEnvStatus(): string
    {
        return Package::getConfig("audit_log_enabled");
    }

    public function getProductionUrl(): string
    {
        return  Package::getConfig("trustpup_io_audit_url");
    }

    public function getStagingUrl(): string
    {
        return Package::getConfig("trustpup_io_audit_url_staging");
    }

    public function isRunningTest(): bool
    {
        return  app()->runningUnitTests();
    }

    public function shouldNotLogEvent(): bool
    {
        if ($this->validateAsBool($this->getAuditLogEnvStatus()) === true) return false;
        return true;
    }

    public function disabled(): bool
    {
        if ($this->isRunningTest()) return true;
        if ($this->shouldNotLogEvent()) return true;
        return false;
    }

    public function getAppVersionUrl(): string
    {
        if (!$this->getAppEnv() === "staging") return $this->getProductionUrl();
        return $this->getStagingUrl();
    }

    protected function validateAsBool(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_BOOLEAN);
    }

    // protected function shouldLogEvent(string $eventName): bool
    // {

    // if (!$this->enableLoggingModelsEvents || $logStatus->disabled()) {
    //     return false;
    // }

    // if (!in_array($eventName, ['created', 'updated'])) {
    //     return true;
    // }

    // // Do not log update event if the model is restoring
    // if ($this->isRestoring()) {
    //     return false;
    // }

    // // Do not log update event if only ignored attributes are changed.
    // return (bool) count(Arr::except($this->getDirty(), $this->activitylogOptions->dontLogIfAttributesChangedOnly));
    //     return true;
    // }
}

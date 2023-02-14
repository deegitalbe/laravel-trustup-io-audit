<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;

class LogStatus
{

    // protected bool $disabledLogStatus = false;

    public function isRunningTest(): bool
    {
        return  app()->runningUnitTests();
    }

    public function shouldNotLogEvent(): bool
    {
        if (!Package::getConfig("app_env") == 'staging' || Package::getConfig("audit_log_enabled") === true) return false;
        return true;
    }

    public function disabled(): bool
    {
        if ($this->isRunningTest()) return true;
        if ($this->shouldNotLogEvent()) return true;
        return false;
    }

    protected function shouldLogEvent(string $eventName): bool
    {

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
        return true;
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs;

interface LogStatusContrat
{
    public function getProductionUrl(): string;

    public function getStagingUrl(): string;

    public function getAppEnv(): string;

    public function getAuditLogEnvStatus(): string;

    public function isRunningTest(): bool;

    public function shouldNotLogEvent(): bool;

    public function disabled(): bool;

    public function getAppUrl(): string;
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;

class LogServiceAdapter implements LogServiceAdapterContract
{
    public function getAppKey(): string
    {
        return TrustupIoAudit::getConfig("app_key");
    }

    public function getQueueConnection(): string
    {
        return env("QUEUE_CONNECTION");
    }

    public function getResponsibleId(): ?string
    {
        return auth()->user()?->id;
    }

    public function getResponsibleType(): string
    {
        return 'user';
    }

    public function getAccountUuid(): ?string
    {
        return null;
    }

    public function getImpersonatedBy(): ?string
    {
        return null;
    }
}

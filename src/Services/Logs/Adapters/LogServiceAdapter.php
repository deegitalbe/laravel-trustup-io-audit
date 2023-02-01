<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

class LogServiceAdapter implements LogServiceAdapterContract
{

    public function getAppKey(): string
    {
        return env("TRUSTUP_APP_KEY");
    }

    public function getResponsibleId(): string
    {
        return auth()->user()->id;
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

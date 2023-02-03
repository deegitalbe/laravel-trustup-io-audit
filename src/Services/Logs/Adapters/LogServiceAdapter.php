<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;

class LogServiceAdapter implements LogServiceAdapterContract
{
    public function getAppKey(): string
    {
        return Package::getConfig("TRUSTUP_APP_KEY");
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

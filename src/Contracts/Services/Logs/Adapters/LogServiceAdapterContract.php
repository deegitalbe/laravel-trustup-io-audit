<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters;

interface LogServiceAdapterContract
{
    public function getAppKey(): string;

    public function getResponsibleId(): string;

    public function getResponsibleType(): string;

    public function getAccountUuid(): string;

    public function getImpersonatedBy(): string;
}
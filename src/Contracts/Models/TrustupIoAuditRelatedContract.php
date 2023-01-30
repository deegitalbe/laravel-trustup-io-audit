<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

interface TrustupIoAuditRelatedContract
{
    public function getTrustupIoAuditData(): array;

    public function getTrustupIoResponsibleId(): string;

    public function getTrustupIoResponsibleType(): string;
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

class TrustupIoAuditRelated implements TrustupIoAuditRelatedContract
{
    public function getTrustupIoAuditData(): array
    {
        return $this->auditData;
    }

    public function getTrustupIoResponsibleId(): string
    {
        return $this->responsibleId;
    }

    public function getTrustupIoResponsibleType(): string
    {
        return $this->responsibleType;
    }
}
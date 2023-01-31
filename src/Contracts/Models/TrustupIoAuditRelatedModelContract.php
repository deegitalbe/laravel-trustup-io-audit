<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

interface TrustupIoAuditRelatedModelContract
{
    public function getTrustupIoAuditPayload(): array;

    public function getTrustupIoAuditModelType(): string;

    public function getTrustupIoAuditModelId(): string;
}

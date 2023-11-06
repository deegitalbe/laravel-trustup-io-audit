<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Illuminate\Database\Eloquent\Model;

trait IsDefaultTrustupIoAuditRelatedModel
{
    use IsTrustupIoAuditRelatedModel;

    public function getTrustupIoAuditPayload(): array
    {
        /** @var Model $this */
        return $this->toArray();
    }
}

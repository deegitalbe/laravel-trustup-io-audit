<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelRelatedModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

interface TrustupIoAuditRelatedModelWithRelationsContract extends ExternalModelRelatedModelContract, TrustupIoAuditRelatedModelContract
{
    public function trustupIoAuditLogs(): ExternalModelRelationContract;

    /** @return Collection<int, ExternalModelContract> */
    public function getTrustupIoAuditLogs(): Collection;

    public function getTrustupIoAuditLogColumn(): string;
}

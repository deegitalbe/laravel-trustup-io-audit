<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

use Illuminate\Database\Eloquent\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelRelatedModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

interface TrustupIoAuditRelatedModelWithRelationsContract extends ExternalModelRelatedModelContract, TrustupIoAuditRelatedModelContract
{
    public function trustupIoAuditLogs(): ExternalModelRelationContract;

    /** @return Collection<int, LogContract> */
    public function getTrustupIoAuditLogs(): Collection;

    public function getTrustupIoAuditLogColumn(): string;
}
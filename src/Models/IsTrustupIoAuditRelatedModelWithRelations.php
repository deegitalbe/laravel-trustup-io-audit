<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Traits\Models\IsExternalModelRelatedModel;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

trait IsTrustupIoAuditRelatedModelWithRelations
{
    use 
        IsTrustupIoAuditRelatedModel,
        IsExternalModelRelatedModel
    ;

    public function getTrustupIoAuditLogColumn(): string
    {
    }

    public function trustupIoAuditLogs(): ExternalModelRelationContract
    {
    }

    /** @return Collection<int, ExternalModelContract> */
    public function getTrustupIoAuditLogs(): Collection
    {
    }
}
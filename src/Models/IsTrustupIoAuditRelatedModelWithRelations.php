<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Traits\Models\IsExternalModelRelatedModel;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

trait IsTrustupIoAuditRelatedModelWithRelations
{
    use
        IsTrustupIoAuditRelatedModel,
        IsExternalModelRelatedModel;

    public function getTrustupIoAuditLogColumn(): string
    {
        return 'trustup_io_audit_log_uuids';
    }

    public function trustupIoAuditLogs(): ExternalModelRelationContract
    {
        return $this->hasManyExternalModels(app()->make(TrustupIoLogLoadingCallback::class), $this->getTrustupIoAuditLogColumn());
    }

    /** @return Collection<int, ExternalModelContract> */
    public function getTrustupIoAuditLogs(): Collection
    {
        return $this->getExternalModels('trustupIoAuditLogs');
    }

    public function initializeIsTrustupIoAuditRelatedModelWithRelations()
    {
        $this->getExternalModelRelationSubscriber()->register($this->trustupIoAuditLogs());
    }
}

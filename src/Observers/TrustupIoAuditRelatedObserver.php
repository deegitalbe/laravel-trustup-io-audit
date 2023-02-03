<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Observers;

use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\HasTrustupIoAuditLogRelationContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;

class TrustupIoAuditRelatedObserver
{

    public function __construct(protected LogService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the User "created" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function created(TrustupIoAuditRelatedModelContract $model)
    {
        $uuid = $this->service->storeModel('created', $model);

        if (!$uuid) return;
        if (!$model instanceof TrustupIoAuditRelatedModelWithRelationsContract) return;

        $model->trustupIoAuditLogs()->addToRelatedModelsByIds($uuid);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function updated(TrustupIoAuditRelatedModelContract $model)
    {
        $this->service->storeModel('updated', $model);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function deleted(TrustupIoAuditRelatedModelContract $model)
    {
        $this->service->storeModel('deleted', $model);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function restored(TrustupIoAuditRelatedModelContract $model)
    {
        $this->service->storeModel('restored', $model);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function forceDeleted(TrustupIoAuditRelatedModelContract $model)
    {
        $this->service->storeModel('forceDeleted', $model);
    }
}

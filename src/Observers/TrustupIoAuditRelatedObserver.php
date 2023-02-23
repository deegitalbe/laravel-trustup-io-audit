<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Observers;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\HasTrustupIoAuditLogRelationContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Illuminate\Database\Eloquent\Model;

class TrustupIoAuditRelatedObserver
{


    public function __construct(protected LogServiceContract $service)
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
        $this->addTorelated($uuid, $model);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function updated(TrustupIoAuditRelatedModelContract $model)
    {
        $uuid = $this->service->storeModel('updated', $model);
        $this->addTorelated($uuid, $model);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function deleted(TrustupIoAuditRelatedModelContract $model)
    {
        $uuid = $this->service->storeModel('deleted', $model);
        $this->addTorelated($uuid, $model);
    }

    protected function addTorelated(?string $uuid, TrustupIoAuditRelatedModelContract|Model $model): void
    {
        // TODO TEST // KILL EVENT TO AVOID CALLING STATIC METHOD
        $model->withoutEvents(function () use ($uuid, $model) {
            if (!$uuid) return;
            if (!$model instanceof TrustupIoAuditRelatedModelWithRelationsContract) return;
            $model->trustupIoAuditLogs()->addToRelatedModelsByIds($uuid);
        });
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Observers;

use Illuminate\Database\Eloquent\Model;
use Deegitalbe\LaravelTrustupIoAudit\Factories\QueueConnectionSyncFactory;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\HasTrustupIoAuditLogRelationContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;

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
        $adapter = app()->make(LogServiceAdapter::class);
        $factory = new QueueConnectionSyncFactory();
        if ($adapter->getQueueConnection() === 'sync') {
             report($factory->create());
             return;
        } ;

        $model->withoutEvents(function () use ($uuid, $model) {
            if (!$uuid) return;
            if (!$model instanceof TrustupIoAuditRelatedModelWithRelationsContract) return;
            $model->trustupIoAuditLogs()->addToRelatedModelsByIds($uuid);
        });
    }
}

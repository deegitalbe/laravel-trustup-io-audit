<?php
 
namespace Deegitalbe\LaravelTrustupIoAudit\Observers;
 
use App\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;

// Use log service to store audit log based on given model
class TrustupIoAuditRelatedObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function created(TrustupIoAuditRelatedModelContract $model)
    {
        //
    }
 
    /**
     * Handle the User "updated" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function updated(TrustupIoAuditRelatedModelContract $model)
    {
        //
    }
 
    /**
     * Handle the User "deleted" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function deleted(TrustupIoAuditRelatedModelContract $model)
    {
        //
    }
 
    /**
     * Handle the User "restored" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function restored(TrustupIoAuditRelatedModelContract $model)
    {
        //
    }
 
    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  TrustupIoAuditRelatedModelContract  $model
     * @return void
     */
    public function forceDeleted(TrustupIoAuditRelatedModelContract $model)
    {
        //
    }
}
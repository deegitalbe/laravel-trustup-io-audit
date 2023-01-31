<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Models;

/** @see https://www.archybold.com/blog/post/booting-eloquent-model-traits */
trait IsTrustupIoAuditRelatedModel
{
    // implement TrustupIoAuditRelatedModelContract execpt getTrustupIoAuditPayload
    // Register TrustupIoAuditRelatedObserver that trigger log service store method on dedicated methods
}
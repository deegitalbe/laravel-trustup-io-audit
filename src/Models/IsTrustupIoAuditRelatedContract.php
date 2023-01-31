<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Deegitalbe\LaravelTrustupIoAudit\Observers\TrustupIoAuditRelatedObserver;
use Illuminate\Support\Str;


trait IsTrustupIoAuditRelatedModel
{
    /**
     * Getting model identifier
     */
    public function getTrustupIoAuditModelId(): string
    {
        /** @var Model $this */
        return $this->uuid ??
            $this->id;
    }

    /**
     * Getting model type for media.trustup.io
     */
    public function getTrustupIoAuditModelType(): string
    {
        /** @var Model $this */
        return Str::slug(str_replace('\\', '-', $this->getMorphClass()));
    }


    /** @see https://www.archybold.com/blog/post/booting-eloquent-model-traits */
    /**
     * Register Observer on static from trait in added models.
     */
    public static function bootIsTrustupIoAuditRelatedModel()
    {
        static::observe(TrustupIoAuditRelatedObserver::class);
    }
}

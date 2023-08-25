<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Factories;

use Deegitalbe\LaravelTrustupIoAudit\Exceptions\Jobs\QueueConnectionSync;

class QueueConnectionSyncFactory {

    public function create(): QueueConnectionSync {

        /** @var QueueConnectionSync */
        $exception = app()->make(QueueConnectionSync::class, [
            "message" => "wrong queue connection logging not available in sync mode"
        ]);

        return $exception;
    }
}
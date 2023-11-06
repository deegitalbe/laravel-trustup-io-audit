<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Exceptions\Jobs;

use Exception;

class QueueConnectionSync extends Exception {

    // protected string $appKey;

    // public function setAppKey(): self
    // {
    //     $this->appKey = 'TBD';
    //     return $this;
    // }

    public function context(): array
    {
        return [
            // "app_key" => $this->appKey,
            "message" => "wrong queue connection logging not available in sync mode"
        ];
    }
}
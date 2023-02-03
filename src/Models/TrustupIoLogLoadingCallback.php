<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\LogContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationLoadingCallbackContract;

class TrustupIoLogLoadingCallback implements ExternalModelRelationLoadingCallbackContract
{
    /** @return Collection<int, LogContract> */
    public function load(Collection $identifiers): Collection
    {
        
    }
}
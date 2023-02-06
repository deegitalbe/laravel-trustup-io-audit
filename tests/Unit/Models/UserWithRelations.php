<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModelWithRelations;
use Illuminate\Foundation\Auth\User as BaseUser;

class UserWithRelations extends BaseUser implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModelWithRelations;


    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModelWithRelations;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;

class UserWithRelations extends User implements TrustupIoAuditRelatedModelWithRelationsContract
{
    use IsTrustupIoAuditRelatedModelWithRelations, SoftDeletes;
    protected $table = 'users';
    protected $fillable =  ["id", "name", "email", "password", "trustup_io_audit_log_uuids", "uuid"];

    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModelWithRelations;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;

class UserWithRelations extends User implements TrustupIoAuditRelatedModelWithRelationsContract
{
    use IsTrustupIoAuditRelatedModelWithRelations, SoftDeletes;
    protected $table = "users_with_relations";
    protected $fillable =  ["id", "name", "email", "password", "uuid"];
    protected $casts = [
        "trustup_io_audit_log_uuids" => 'object'
    ];
    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

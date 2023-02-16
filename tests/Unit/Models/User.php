<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as BaseUser;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;

class User extends BaseUser implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModel, SoftDeletes;
    protected $table = 'users';
    protected string $uuid = "test";
    protected $fillable = ["id", "name", "email", "password", "trustup_io_audit_log_uuids", "uuid"];

    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

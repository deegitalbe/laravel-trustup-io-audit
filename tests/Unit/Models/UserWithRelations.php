<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModelWithRelations;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;

class UserWithRelations extends User implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModelWithRelations, SoftDeletes;
    protected $table = 'users';
    protected string $uuid = "test";
    protected $fillable = ["name", "email", "password"];
    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

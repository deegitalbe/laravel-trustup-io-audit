<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModel, SoftDeletes;
    protected $table = 'users';
    protected string $uuid = "test";
    protected $fillable = ["name", "email", "password"];

    public function getTrustupIoAuditPayload(): array
    {
        return [];
    }
}

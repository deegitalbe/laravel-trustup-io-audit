<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as BaseUser;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;

class User extends BaseUser implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModel, SoftDeletes;
    protected $fillable = ["id", "name", "email", "password", "uuid"];

    public function getTrustupIoAuditPayload(): array
    {
        return  $this->getAttributes();
    }
}

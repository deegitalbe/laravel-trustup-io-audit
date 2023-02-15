<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Traits;

use Illuminate\Database\Schema\Blueprint;

trait TrustupioAuditRelatedMigrations
{
    public function addAuditLogColumn(Blueprint $table): self
    {
        $table->json('trustup_io_audit_log_uuids')->nullable();
        return $this;
    }

    public function removeAuditLogColumn(Blueprint $table): self
    {
        $table->dropColumn('trustup_io_audit_log_uuids');
        return $this;
    }
}

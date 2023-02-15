<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Traits;

use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

trait TrustupioAuditRelatedMigrations
{
    public function addAuditLogColumn($table, $column): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dateTime('completed_at')->nullable();
        });
    }

    public function removeAuditLogColumn(Blueprint $table): Fluent
    {
        return  $table->dropColumn('trustup_io_audit_log_uuids');
    }
}

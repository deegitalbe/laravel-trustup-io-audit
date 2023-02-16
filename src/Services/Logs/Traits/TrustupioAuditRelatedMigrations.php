<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

trait TrustupioAuditRelatedMigrations
{
    public function addAUditLogColumn(string $model, string  $column = 'trustup_io_audit_log_uuids'): void
    {
        Schema::table($model, function (Blueprint $table) use ($column) {
            $table->json($column)->nullable();
        });
    }

    public function removeAuditLogColumn(string $table, string  $column = 'trustup_io_audit_log_uuids'): void
    {
        Schema::table($table, function (Blueprint $table) use ($column) {
            $table->dropColumn($column);
        });
    }
}

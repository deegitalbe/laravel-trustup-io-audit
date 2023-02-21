<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;


use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Deegitalbe\LaravelTrustupIoAudit\Tests\traits\isUserWithRelated;
use Deegitalbe\LaravelTrustupIoAudit\Tests\traits\isUserWithRelatedTest;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContract;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\database\migrations\CreateUsersWithRelationsTable;




class IsTrustupIoAuditRelatedModelWithRelationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase, isUserWithRelated;

    public function test_that_it_can_save_log_with_related_model_with_relaion_saved_log_uuids()
    {
        $this->migrateUserWithRelations();

        /** @var LogStatus */
        $logStatus = app()->make(LogStatusContract::class);
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);

        $this->be(new UserWithRelations(["id" => 2]));
        $user = $this->createUserWithRelation();

        $this->assertDatabaseHas("users_with_relations", [
            "trustup_io_audit_log_uuids" => json_encode($user->fresh()->trustup_io_audit_log_uuids)
        ]);
    }
}

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



class IsTrustupIoAuditRelatedModelWithRelationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase, isUserWithRelated;

    public function test_that_it_can_save_log_with_related_model_with_relaion_saved_log_uuids()
    {
        /** @var LogStatus */
        $logStatus = app()->make(LogStatus::class);
        $this->be(new UserWithRelations(["id" => 2]));
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        $user = $this->createUserWithRelation();
        $user = UserWithRelations::get();
        $this->assertDatabaseHas("users", [
            "trustup_io_audit_log_uuids" => ''
        ]);
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;


use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Deegitalbe\LaravelTrustupIoAudit\Models\TrustupIoLogLoadingCallback;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationSubscriberContract;


class IsTrustupIoAuditRelatedModelWithRelationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    public function test_that_it_can_save_log_with_related_model_with_relaion_saved_log_uuids()
    {
        /** @var LogStatus */
        $logStatus = app()->make(LogStatus::class);
        $this->be(new UserWithRelations(["id" => 2]));
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        $user = $this->createUserWithRelation();
        $user = UserWithRelations::get();
        dd($user);
        $this->assertDatabaseHas("users", [
            "trustup_io_audit_log_uuids"
        ]);
    }

    protected function createUserWithRelation(): UserWithRelations
    {
        $user = new UserWithRelations();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Tests\traits\isUserWithRelated;

class TrustupioAuditRelatedMigrationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase, isUserWithRelated;


    /**
     * Mocking LogService.
     *
     * @return LogService|MockInterface
     */
    protected function mockLogService(): MockInterface
    {
        /** @var LogService */
        return $this->mockThis(LogService::class);
    }


    public function test_that_it_can_add_audit_column_migration_with_trait()
    {
        $this->migrateUserWithoutRelations();
        /** assert that model have column audit */
        $user = $this->createUserWithoutRelation();
        $this->be($user);
        $this->assertDatabaseHas("users", ["trustup_io_audit_log_uuids" => null]);
    }
}

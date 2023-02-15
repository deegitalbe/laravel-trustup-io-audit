<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;

use Mockery\MockInterface;
use Illuminate\Support\Facades\Bus;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit as FacadesTrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;

class TrustupioAuditRelatedMigrationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;


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
        /** assert that model have column audit */
        $user = $this->createUser();
        $this->assertDatabaseHas("users", ["trustup_io_audit_log_uuids" => null]);
    }


    // MIGHT BE USEFULL
    protected function createUser(): User
    {
        $user = new User();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop"]);
    }
}

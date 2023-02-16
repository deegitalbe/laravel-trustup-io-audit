<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Observers\TrustupIoAuditRelatedObserver;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit as FacadesTrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Bus;

class LogStatusTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;


    /**
     * Mocking LogServiceContract.
     *
     * @return LogServiceContract|MockInterface
     */
    protected function mockLogService(): MockInterface
    {
        /** @var LogServiceContract */
        return $this->mockThis(LogServiceContract::class);
    }

    /**
     * Mocking StoreLogRequestContract.
     *
     * @return StoreLogRequestContract|MockInterface
     */
    protected function mockStoreLogRequestContract(): MockInterface
    {
        /** @var StoreLogRequestContract */
        return $this->mockThis(StoreLogRequestContract::class);
    }

    /**
     * Mocking TrustupIoAuditRelatedObserver.
     *
     * @return TrustupIoAuditRelatedObserver|MockInterface
     */
    protected function mockTrustupIoAuditRelatedObserver(): MockInterface
    {
        /** @var TrustupIoAuditRelatedObserver */
        return $this->mockThis(TrustupIoAuditRelatedObserver::class);
    }

    /**
     * Mocking TrustupIoAuditRelatedModelContract.
     *
     * @return TrustupIoAuditRelatedModelContract|MockInterface
     */
    protected function mockTrustupIoAuditRelatedModelContract(): MockInterface
    {
        /** @var TrustupIoAuditRelatedModelContract */
        return $this->mockThis(TrustupIoAuditRelatedModelContract::class);
    }

    public function test_that_log_service_do_not_trigger_while_testing()
    {
        /** Creating user that implements trait to trigger the observer */
        $request = $this->mockThis(StoreLogRequestContract::class);
        $request->shouldNotReceive("storeRequest");

        $this->createUser();
    }

    public function test_that_log_service_can_trigger_if_enable()
    {
        $str = "test";
        $mock = FacadesTrustupIoAudit::mock();
        $model = $this->mockTrustupIoAuditRelatedModelContract();
        $mock->shouldReceive("storeModel")->once()->with("created", $model)->andReturn($str);
        $mock->storeModel("created", $model);
    }

    protected function createUser(): User
    {
        $fake = app()->make(Faker::class);
        $user = new User();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop"]);
    }
}

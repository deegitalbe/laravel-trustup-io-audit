<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;

class LogServiceTest extends TestCase
{
    use InstallPackageTest, TestSuite;

    /**
     * Mocking LogServiceContract.
     * 
     * @return LogServiceContract|MockInterface
     */
    protected function mockLogServiceContract(): MockInterface
    {
        /** @var LogServiceContract */
        return $this->mockThis(LogServiceContract::class);
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

    public function test_that_it_can_store_a_model()
    {
        $uuid = "uuid";
        $eventName = "test_event";

        $dataModel = $this->mockThis(TrustupIoAuditRelatedModelContract::class);
        /** @var LogService */
        $model = app()->make(LogService::class);
        $mockModel = $this->mockLogServiceContract();

        $mockModel->shouldReceive('getTrustupIoAuditPayload')->once()->with($dataModel)->andReturnSelf([]);

        $mockModel->shouldReceive('storeModel')->once()->with($eventName, $dataModel)->passthru();


        $this->assertEquals($uuid, $model->storeModel($eventName, $dataModel));
    }
}

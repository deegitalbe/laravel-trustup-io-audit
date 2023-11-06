<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContract;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;

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
     * Mocking LogService.
     *
     * @return LogService|MockInterface
     */
    protected function mockLogService(): MockInterface
    {
        /** @var LogService */
        return $this->mockThis(LogService::class);
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

    /**
     * Mocking LogEndpointContract.
     *
     * @return LogEndpointContract|MockInterface
     */
    protected function mockLogEndpointContract(): MockInterface
    {
        /** @var LogEndpointContract */
        return $this->mockThis(LogEndpointContract::class);
    }

    /**
     * Mocking LogServiceAdapterContract.
     *
     * @return LogServiceAdapterContract|MockInterface
     */
    protected function mockLogServiceAdapterContract(): MockInterface
    {
        /** @var LogServiceAdapterContract */
        return $this->mockThis(LogServiceAdapterContract::class);
    }

    /**
     * Mocking StoreLogRequest.
     *
     * @return StoreLogRequest|MockInterface
     */
    protected function mockLogStoreLogRequest(): MockInterface
    {
        /** @var StoreLogRequest */
        return $this->mockThis(StoreLogRequest::class);
    }

    public function test_that_it_can_store_a_model()
    {
        TrustupIoAudit::mock();
        $str = "2";
        $eventName = "test_event";

        $logService = $this->mockLogService();
        $request = $this->mockLogStoreLogRequest();
        $trustupIoAuditRelatedModelContract = $this->mockTrustupIoAuditRelatedModelContract();
        $logServiceAdapater = $this->mockLogServiceAdapterContract();

        $request->shouldReceive('setEventName')->once()->with($eventName)->andReturnSelf();
        $request->shouldReceive('setPayload')->once()->with([])->andReturnSelf();
        $request->shouldReceive('setModelId')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setModelType')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setResponsibleId')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setResponsibleType')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setAppKey')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setAccountUuid')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setImpersonatedBy')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setLoggedAt')->once()->withNoArgs()->andReturnSelf();
        $request->shouldReceive('setIp')->once()->withNoArgs()->andReturnSelf();


        $logService->shouldReceive('getAdapter')->times(5)->withNoArgs()->andReturn($logServiceAdapater);

        $logServiceAdapater->shouldReceive('getResponsibleId')->once()->withNoArgs()->andReturn($str);
        $logServiceAdapater->shouldReceive('getResponsibleType')->once()->withNoArgs()->andReturn($str);
        $logServiceAdapater->shouldReceive('getAppKey')->once()->withNoArgs()->andReturn($str);
        $logServiceAdapater->shouldReceive('getAccountUuid')->once()->withNoArgs()->andReturn($str);
        $logServiceAdapater->shouldReceive('getImpersonatedBy')->once()->withNoArgs()->andReturn($str);

        $trustupIoAuditRelatedModelContract->shouldReceive('getTrustupIoAuditPayload')->once()->withNoArgs()->andReturn([]);
        $trustupIoAuditRelatedModelContract->shouldReceive('getTrustupIoAuditModelId')->once()->withNoArgs()->andReturn($str);
        $trustupIoAuditRelatedModelContract->shouldReceive('getTrustupIoAuditModelType')->once()->withNoArgs()->andReturn($str);

        $logService->shouldReceive('storeRequest')->once()->with($request)->andReturn($str);

        $logService->shouldReceive('storeModel')->once()->with($eventName, $trustupIoAuditRelatedModelContract)->passthru();


        $this->assertEquals($str, $logService->storeModel($eventName, $trustupIoAuditRelatedModelContract));
    }


    public function test_that_it_can_store_attributes()
    {
        $str = "test";
        $request = $this->mockLogStoreLogRequest();
        $logService = $this->mockLogService();


        $request->shouldReceive('setEventName')->once()->with($str)->andReturnSelf();
        $request->shouldReceive('setLoggedAt')->once()->withNoArgs()->andReturnSelf();
        $request->shouldReceive('fromArray')->once()->with([])->andReturnSelf();
        $request->shouldReceive('setIp')->once()->withNoArgs()->andReturnSelf();

        $logService->shouldReceive('storeRequest')->once()->with($request)->andReturn($str);
        $logService->shouldReceive('storeAttributes')->once()->with($str, [])->passthru();

        $this->assertEquals($str, $logService->storeAttributes($str, []));
    }



    public function test_that_it_can_store_request()
    {
        $str = "test";
        TrustupIoAudit::mock();
        $logService = $this->mockLogService();
        $endpoint = $this->mockLogEndpointContract();
        $request = $this->mockLogStoreLogRequest();

        $request->shouldReceive('getUuid')->once()->withNoArgs()->andReturn($str);

        $this->expectsJobs(CallLogEndpoint::class);
        $logService->shouldReceive('storeRequest')->once()->with($request)->passthru();

        $this->assertEquals($str, $logService->storeRequest($request));
    }
}

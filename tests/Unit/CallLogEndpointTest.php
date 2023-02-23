<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class CallLogEndpointTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    /**
     * Mocking CallLogEndpoint.
     *
     * @return CallLogEndpoint|MockInterface
     */
    protected function mockCallLogEndpoint(): MockInterface
    {
        /** @var CallLogEndpoint */
        return $this->mockThis(CallLogEndpoint::class);
    }


    /**
     * Mocking StoreLogRequest.
     *
     * @return StoreLogRequest|MockInterface
     */
    protected function mockStoreLogRequest(): MockInterface
    {
        /** @var StoreLogRequest */
        return $this->mockThis(StoreLogRequest::class);
    }

    /**
     * Mocking LogEndpoint.
     *
     * @return LogEndpoint|MockInterface
     */
    protected function mockLogEndpoint(): MockInterface
    {
        /** @var LogEndpoint */
        return $this->mockThis(LogEndpoint::class);
    }

    /**
     * Mocking StoreLogResponseContract.
     *
     * @return StoreLogResponseContract|MockInterface
     */
    protected function mockStoreLogResponseContract(): MockInterface
    {
        /** @var StoreLogResponseContract */
        return $this->mockThis(StoreLogResponseContract::class);
    }


    public function test_that_it_can_handle()
    {
        $endpoint = $this->mockLogEndpoint();
        $request = $this->mockStoreLogRequest();
        $response = $this->mockStoreLogResponseContract();
        $callLogEndpoint = $this->mockCallLogEndpoint();

        $this->setPrivateProperty('request', $request, $callLogEndpoint);
        $endpoint->shouldReceive('store')->once()->with($request)->andReturn($response);

        $callLogEndpoint->shouldReceive('handle')->once()->with($endpoint)->passthru();
        $this->assertInstanceOf(StoreLogResponseContract::class, $callLogEndpoint->handle($endpoint));
    }
}

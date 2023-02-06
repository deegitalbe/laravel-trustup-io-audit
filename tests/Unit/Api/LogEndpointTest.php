<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

class LogEndpointTest extends TestCase
{
    use InstallPackageTest, TestSuite;

    /**
     * Mocking ResponseContract.
     * 
     * @return ResponseContract|MockInterface
     */
    protected function mockResponseContract(): MockInterface
    {
        /** @var ResponseContract */
        return $this->mockThis(ResponseContract::class);
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
     * Mocking IndexLogRequestContract.
     * 
     * @return IndexLogRequestContract|MockInterface
     */
    protected function mockIndexLogRequestContract(): MockInterface
    {
        /** @var IndexLogRequestContract */
        return $this->mockThis(IndexLogRequestContract::class);
    }

    public function test_it_can_store_and_return_response()
    {
        $logEndpoint = app()->make(LogEndpoint::class);
        $client = $this->mockThis(ClientContract::class);
        $endpoint = $this->mockLogEndpoint(LogEndpoint::class);
        $storeLogRequest = $this->mockStoreLogRequestContract();
        $response = $this->mockResponseContract();
        $tryResponse = $this->mockThis(TryResponseContract::class);

        $request = $this->mockThis(RequestContract::class);
        $this->setPrivateProperty('client', $client, $endpoint);

        $request->shouldReceive('setVerb')->once()->with("POST")->andReturnSelf();
        $request->shouldReceive('setUrl')->once()->with("logs")->andReturnSelf();
        $request->shouldReceive('addData')->once()->with([])->andReturnSelf();

        $endpoint->shouldReceive('store')->once()->with($storeLogRequest)->passthru();

        $storeLogRequest->shouldReceive('toArray')->once()->withNoArgs()->andReturn([]);
        $tryResponse->shouldReceive('response')->once()->withNoArgs()->andReturn($response);

        $client->shouldReceive('try')->once()->with($request, "Cannot store log")->andReturn($tryResponse);

        $this->assertInstanceOf(StoreLogResponseContract::class, $endpoint->store($storeLogRequest));
    }


    public function test_it_can_get_index()
    {
        $logEndpoint = app()->make(LogEndpoint::class);
        $client = $this->mockThis(ClientContract::class);
        $endpoint = $this->mockLogEndpoint(LogEndpoint::class);
        $indexLogRequestContract = $this->mockIndexLogRequestContract();
        $response = $this->mockResponseContract();
        $tryResponse = $this->mockThis(TryResponseContract::class);

        $request = $this->mockThis(RequestContract::class);
        $this->setPrivateProperty('client', $client, $endpoint);
        $this->setPrivateProperty('request', $request, $endpoint);


        $request->shouldReceive('setVerb')->once()->with("GET")->andReturnSelf();
        $request->shouldReceive('setUrl')->once()->with("logs")->andReturnSelf();
        $request->shouldReceive('addQuery')->once()->with(['uuids' => []])->andReturnSelf();
        $endpoint->shouldReceive('index')->once()->with($indexLogRequestContract)->passthru();

        $indexLogRequestContract->shouldReceive('getUuids')->once()->withNoArgs()->andReturn(collect());

        $tryResponse->shouldReceive('response')->once()->withNoArgs()->andReturn($response);
        $client->shouldReceive('try')->once()->with($request, "Cannot get logs")->andReturn($tryResponse);

        $this->assertInstanceOf(IndexLogResponseContract::class, $endpoint->index($indexLogRequestContract));
    }
}

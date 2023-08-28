<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Mockery\MockInterface;
use Illuminate\Support\Facades\Config;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Henrotaym\LaravelApiClient\Exceptions\RequestRelatedException;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Exceptions\Jobs\QueueConnectionSync;
use Deegitalbe\LaravelTrustupIoAudit\Factories\QueueConnectionSyncFactory;
use Exception;

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
        $tryResponse = $this->mockThis(TryResponseContract::class);


        $this->setPrivateProperty('request', $request, $callLogEndpoint);
        $endpoint->shouldReceive('store')->once()->with($request)->andReturn($response);
        $response->shouldReceive("getResponse")->once()->withNoArgs()->andReturn($tryResponse);
        $tryResponse->shouldReceive("failed")->once()->withNoArgs()->andReturnFalse();
        $callLogEndpoint->shouldReceive('onConnection')->once()->andReturn(false);
        $callLogEndpoint->shouldReceive('handle')->once()->with($endpoint)->passthru();
        $this->assertInstanceOf(StoreLogResponseContract::class, $callLogEndpoint->handle($endpoint));
    }

    public function test_that_if_there_is_no_uuid_it_throw_an_error()
    {
        $endpoint = $this->mockLogEndpoint();
        $request = $this->mockStoreLogRequest();
        $response = $this->mockStoreLogResponseContract();
        $callLogEndpoint = $this->mockCallLogEndpoint();
        $tryResponse = $this->mockThis(TryResponseContract::class);
        $exception = $this->mockThis(RequestRelatedException::class);

        $this->setPrivateProperty('request', $request, $callLogEndpoint);


        $endpoint->shouldReceive('store')->once()->with($request)->andReturn($response);

        $response->shouldReceive("getResponse")->twice()->withNoArgs()->andReturn($tryResponse);
        $tryResponse->shouldReceive("failed")->once()->withNoArgs()->andReturnTrue();

        $callLogEndpoint->shouldReceive('handle')->once()->with($endpoint)->passthru();
        $callLogEndpoint->shouldReceive('onConnection')->once()->andReturnFalse();
        $tryResponse->shouldReceive("error")->once()->withNoArgs()->andThrow($exception);

        try {
            $callLogEndpoint->handle($endpoint);
        } catch (\Throwable $th) {

            // $this->expectException(RequestRelatedException::class);
            // $this->expectExceptionMessage('Request failed.');
            $this->assertSame($th->getMessage(), "Request failed.");
        }

        // try {
        // } catch (\Throwable $th) {
        // }
    }

    public function test_that_it_throw_an_error_on_queue_connection_sync(){
        $endpoint = $this->mockLogEndpoint();
        $request = $this->mockStoreLogRequest();
        $callLogEndpoint = $this->mockCallLogEndpoint();
        $factory = $this->app->make(QueueConnectionSyncFactory::class);
        $exception = $this->mockThis(Exception::class);

        $this->setPrivateProperty('request', $request, $callLogEndpoint);
        $callLogEndpoint->shouldReceive("onConnection")->once()->with('sync')->andReturnSelf();

        $callLogEndpoint->shouldReceive('handle')->once()->with($endpoint)->passthru();

        
        $this->assertEquals(null, $callLogEndpoint->handle($endpoint));
    } 

    public function test_that_exception_return_the_correct_arguments(){
        $factory = app()->make(QueueConnectionSyncFactory::class);
        $exception = $factory->create();

        $this->assertInstanceOf(QueueConnectionSync::class, $exception);
        $this->assertEquals(
            "wrong queue connection logging not available in sync mode",
            $exception->getMessage()
        );
    }
}

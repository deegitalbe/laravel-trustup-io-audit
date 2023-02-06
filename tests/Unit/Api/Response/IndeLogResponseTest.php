<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\IndexLogResponse;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Illuminate\Http\Client\Response;
use stdClass;

class IndexLogResponseTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    /**
     * Mocking IndexLogResponse.
     * 
     * @return IndexLogResponse|MockInterface
     */
    protected function mockIndexLogResponse(): MockInterface
    {
        /** @var IndexLogResponse */
        return $this->mockThis(IndexLogResponse::class);
    }


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
     * Mocking Response.
     * 
     * @return Response|MockInterface
     */
    protected function mockResponse(): MockInterface
    {
        /** @var Response */
        return $this->mockThis(Response::class);
    }

    public function test_that_it_can_get_logs()
    {
        $arr = ['data' => ["somekey" => "withdata"]];
        $indexLogResponse = $this->mockIndexLogResponse();
        $responseContract = $this->mockResponseContract();
        $response = $this->mockResponse();

        $indexLogResponse->shouldReceive('getResponse')->twice()->withNoArgs()->andReturn($responseContract);

        $responseContract->shouldReceive('get')->once()->with(true)->andReturn(collect($arr));
        $responseContract->shouldReceive('response')->once()->withNoArgs()->andReturn($response);

        $response->shouldReceive('failed')->once()->withNoArgs()->andReturnFalse();

        // $indexLogResponse->shouldReceive('getLogs')->once()->withNoArgs()->andReturn(collect());

        $indexLogResponse->shouldReceive('getLogs')->once()->withNoArgs()->passthru();

        $this->assertEquals(collect(), $indexLogResponse->getLogs());
    }
}

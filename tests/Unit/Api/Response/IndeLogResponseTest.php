<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\IndexLogResponse;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Illuminate\Support\Collection;

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
     * Mocking LogContract.
     *
     * @return LogContract|MockInterface
     */
    protected function mockLogContract(): MockInterface
    {
        /** @var LogContract */
        return $this->mockThis(LogContract::class);
    }

    /**
     * Mocking TryResponseContract.
     *
     * @return TryResponseContract|MockInterface
     */
    protected function mockTryResponseContract(): MockInterface
    {
        /** @var TryResponseContract */
        return $this->mockThis(TryResponseContract::class);
    }

    public function test_that_it_can_get_logs()
    {
        $log = ["somekey" => "withdata"];
        $arr = ['data' => [$log]];
        $indexLogResponse = $this->mockIndexLogResponse();
        $tryResponseContract = $this->mockTryResponseContract();
        $responseContract = $this->mockResponseContract();
        $ogContract = $this->mockLogContract();

        $indexLogResponse->shouldReceive('getResponse')->twice()->withNoArgs()->andReturn($tryResponseContract);

        $tryResponseContract->shouldReceive('response')->once()->withNoArgs()->andReturn($responseContract);
        $tryResponseContract->shouldReceive('failed')->once()->withNoArgs()->andReturnFalse();

        $responseContract->shouldReceive('get')->once()->with(true)->andReturn(collect($arr));

        $indexLogResponse->shouldReceive('transformRawLog')->once()->with($log)->andReturn($ogContract);

        $indexLogResponse->shouldReceive('getLogs')->once()->withNoArgs()->passthru();

        $this->assertInstanceOf(Collection::class, $indexLogResponse->getLogs());
    }
}

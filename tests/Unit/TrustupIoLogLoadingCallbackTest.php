<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Models\TrustupIoLogLoadingCallback;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class TrustupIoLogLoadingCallbackTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    /**
     * Mocking TrustupIoLogLoadingCallback.
     *
     * @return TrustupIoLogLoadingCallback|MockInterface
     */
    protected function mockTrustupIoLogLoadingCallback(): MockInterface
    {
        /** @var TrustupIoLogLoadingCallback */
        return $this->mockThis(TrustupIoLogLoadingCallback::class);
    }

    public function test_taht_it_can_load_logs()
    {
        $identifiers = collect(["uuid" => "test"]);
        $indexLogRequestContract = $this->mockThis(IndexLogRequestContract::class);
        $indexLogResponseContract = $this->mockThis(IndexLogResponseContract::class);
        $logContract = $this->mockThis(LogContract::class);
        $logEndpointContract = $this->mockThis(LogEndpointContract::class);
        $mock = $this->mockTrustupIoLogLoadingCallback();
        $this->setPrivateProperty('indexLogRequestContract', $indexLogRequestContract, $mock);
        $this->setPrivateProperty('endpoint', $logEndpointContract, $mock);

        $indexLogRequestContract->shouldReceive("setUuids")->once()->with($identifiers)->andReturnSelf();
        $logEndpointContract->shouldReceive("index")->once()->with($indexLogRequestContract)->andReturn($indexLogResponseContract);
        $indexLogResponseContract->shouldReceive("getLogs")->once()->withNoArgs()->andReturn(collect($logContract));

        $mock->shouldReceive("load")->once()->with($identifiers)->passthru();
        $this->assertEquals(collect($logContract), $mock->load($identifiers));
    }
}

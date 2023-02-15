<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature;

use Mockery\MockInterface;
use Illuminate\Support\Facades\Bus;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Support\Testing\Fakes\BusFake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit as FacadesTrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;

class LogStatusTest extends TestCase
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

    public function test_that_log_service_do_not_trigger_while_testing()
    {
        /** Creating user that implements trait to trigger the observer */
        $this->createUser();

        $request = $this->mockThis(StoreLogRequestContract::class);
        /** assert that storeRequest is not triggered */
        $logService = app()->make(LogService::class);
        $this->assertTrue($this->never($logService->storeRequest($request))->isNever());
    }

    public function test_that_log_service_can_trigger_if_enable()
    {
        Bus::fake([
            CallLogEndpoint::class,
        ]);

        $string = "test";
        $request = $this->mockStoreLogRequestContract();
        $endpoint = $this->mockThis(LogEndpointContract::class);
        $logService = $this->mockLogService();
        /** Creating user that implements trait to trigger the observer */
        /** Use facade to mock and enable audit while testing */
        FacadesTrustupIoAudit::mock();
        $this->createUser();

        $request->shouldReceive("getUuid")->once()->withNoArgs()->andReturn($string);
        $logService->shouldReceive("getEndpoint")->once()->withNoArgs()->andReturn($endpoint);

        $logService->shouldReceive("storeRequest")->once()->with($request)->passthru();
        /** Assert that storeRequest is trigered */
        $this->assertEquals($string, $logService->storeRequest($request));
    }

    protected function createUser(): User
    {

        $user = new User();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop"]);
    }
}

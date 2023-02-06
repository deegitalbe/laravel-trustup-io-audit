<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\LogResponseContract;
use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;

class LogResponseTest extends TestCase
{
    use InstallPackageTest;


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
     * Mocking TryResponseContract.
     * 
     * @return TryResponseContract|MockInterface
     */
    protected function mockTryResponseContract(): MockInterface
    {
        /** @var TryResponseContract */
        return $this->mockThis(TryResponseContract::class);
    }


    public function test_it_can_set_response()
    {
        $tryResponse = $this->mockTryResponseContract();
        $model = app()->make(LogResponseContract::class);
        $this->assertInstanceOf(LogResponseContract::class, $model->setResponse($tryResponse));
        $this->assertEquals($tryResponse, $this->getPrivateProperty('response', $model));
    }

    public function test_it_can_get_response()
    {
        $response = $this->mockTryResponseContract();
        $model = app()->make(LogResponseContract::class);
        $this->setPrivateProperty('response', $response, $model);
        $this->assertEquals($response, $model->getResponse());
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Mockery\MockInterface;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

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


    public function test_it_can_set_response()
    {
        $response = $this->mockResponseContract();
        $model = app()->make(StoreLogResponseContract::class);
        $this->assertInstanceOf(StoreLogResponseContract::class, $model->setResponse($response));
        $this->assertEquals($response, $this->getPrivateProperty('response', $model));
    }

    public function test_it_can_get_response()
    {
        $response = $this->mockResponseContract();
        $model = app()->make(StoreLogResponseContract::class);
        $this->setPrivateProperty('response', $response, $model);
        $this->assertEquals($response, $model->getResponse());
    }
}

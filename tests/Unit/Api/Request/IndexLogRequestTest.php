<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Request;

use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\IndexLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class IndexLogRequestTest extends TestCase
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


    public function test_that_it_can_set_uuids()
    {
        $collect = collect();
        $model = app()->make(IndexLogRequest::class);
        $this->assertEquals($model, $model->setUuids($collect));
        $this->assertEquals($collect, $this->getPrivateProperty('uuids', $model));
    }

    public function test_that_it_can_get_uuids()
    {
        $collect = collect();
        $model = app()->make(IndexLogRequest::class);
        $this->setPrivateProperty('uuids', $collect, $model);
        $this->assertEquals($collect, $model->getUuids());
    }
}

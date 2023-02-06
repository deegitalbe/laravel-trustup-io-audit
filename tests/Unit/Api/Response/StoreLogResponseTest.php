<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use stdClass;

class StoreLogResponseTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_get_uuid()
    {
        $uuid = "uuid";
        $test = new stdClass();
        $test->log_uuid = $uuid;
        $responseContract = $this->mockThis(ResponseContract::class);
        $model = app()->make(StoreLogResponseContract::class);
        $this->setPrivateProperty('response', $responseContract, $model);
        $this->setPrivateProperty('uuid', $uuid, $model);
        $responseContract->shouldReceive('get')->once()->withNoArgs()->andReturn($uuid);
        $this->assertEquals($uuid, $model->getUuid());
    }
}

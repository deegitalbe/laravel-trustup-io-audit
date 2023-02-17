<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Api\Response;

use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use stdClass;

class StoreLogResponseTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_get_uuid()
    {
        $uuid = "uuid";
        $test = new stdClass();
        $test->log_uuid = $uuid;
        $tryResponseContract = $this->mockThis(TryResponseContract::class);
        $response = $this->mockThis(ResponseContract::class);

        $model = app()->make(StoreLogResponseContract::class);
        $this->setPrivateProperty('response', $tryResponseContract, $model);
        $this->setPrivateProperty('uuid', $uuid, $model);
        $tryResponseContract->shouldReceive('response')->once()->withNoArgs()->andReturn($response);
        $response->shouldReceive('get')->once()->withNoArgs()->andReturn($test);
        $this->assertEquals($uuid, $model->getUuid());
    }
}

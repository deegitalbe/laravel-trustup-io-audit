<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreRequest;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;


class StoreRequestTest extends TestCase
{

    public function test_toArray()
    {
        $mock = $this->mockThis(StoreRequest::class);
        $log = $this->mockThis(LogContract::class);

        $mock->shouldReceive('toArray')->once()->with($log)->passthru();
        $test = app()->make(StoreRequest::class);
        $this->assertIsArray($test->toArray($log));
    }
}

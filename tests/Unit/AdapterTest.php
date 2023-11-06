<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class AdapterTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    public function test_that_it_can_instantiate_config()
    {
        $adapter = app()->make(LogServiceAdapterContract::class);

        $this->assertInstanceOf(LogServiceAdapter::class, $adapter);
    }
}

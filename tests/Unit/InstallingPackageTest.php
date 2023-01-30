<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Providers\LaravelTrustupIoAuditServiceProvider;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class InstallingPackageTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_instanciate_service_provider()
    {
        $this->assertInstanceOf(LogEndpointContract::class, $this->app->make(LogEndpointContract::class));
    }
}
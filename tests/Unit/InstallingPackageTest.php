<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\TrustupIoAuditContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class InstallingPackageTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_instanciate_facade()
    {
        $this->assertInstanceOf(TrustupIoAudit::class, $this->app->make(TrustupIoAuditContract::class));
    }
}

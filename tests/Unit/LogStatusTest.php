<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;

class LogStatusesTest extends TestCase
{
    use InstallPackageTest, TestSuite;

    /**
     * Mocking LogStatus.
     *
     * @return LogStat|MockInterface
     */
    protected function mockLogStatus(): MockInterface
    {
        /** @var LogStatus */
        return $this->mockThis(LogStatus::class);
    }
    public function test_that_disabled_return_false_if_app_running_test()
    {
        $logStatus = $this->mockLogStatus();

        $logStatus->shouldReceive("isEnabled")->once()->withNoArgs()->passthru();
        $this->assertFalse($logStatus->isEnabled());
    }

    public function test_that_isEnabled_return_false_if_package_disable()
    {

        TrustupIoAudit::mock();
        TrustupIoAudit::disable();
        $logStatus = $this->mockLogStatus();

        $logStatus->shouldReceive("isEnabled")->once()->withNoArgs()->passthru();
        $this->assertFalse($logStatus->isEnabled());
    }

    public function test_that_isEnabled_return_true_if_package_is_mock()
    {
        TrustupIoAudit::enable();
        TrustupIoAudit::mock();
        $logStatus = $this->mockLogStatus();
        $logStatus->shouldReceive("isEnabled")->once()->withNoArgs()->passthru();
        $this->assertTrue($logStatus->isEnabled());
    }
}

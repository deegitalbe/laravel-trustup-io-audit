<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

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
    public function test_that_disabled_return_true_if_app_running_test()
    {
        $logStatus = $this->mockLogStatus();
        $logStatus->shouldReceive("isRunningTest")->once()->withNoArgs()->andReturnTrue();
        $logStatus->shouldReceive("disabled")->once()->withNoArgs()->passthru();
        $this->assertTrue($logStatus->disabled());
    }

    public function test_that_disabled_return_true_if_app_running_test_return_fale_and_shouldNotLog_event_true()
    {
        $logStatus = $this->mockLogStatus();
        $logStatus->shouldReceive("isRunningTest")->once()->withNoArgs()->andReturnFalse();
        $logStatus->shouldReceive("shouldNotLogEvent")->once()->withNoArgs()->andReturnTrue();
        $logStatus->shouldReceive("disabled")->once()->withNoArgs()->passthru();
        $this->assertTrue($logStatus->disabled());
    }

    public function test_that_disabled_return_false_if_both_verification_return_false()
    {
        $logStatus = $this->mockLogStatus();
        $logStatus->shouldReceive("isRunningTest")->once()->withNoArgs()->andReturnFalse();
        $logStatus->shouldReceive("shouldNotLogEvent")->once()->withNoArgs()->andReturnFalse();
        $logStatus->shouldReceive("disabled")->once()->withNoArgs()->passthru();
        $this->assertFalse($logStatus->disabled());
    }
}

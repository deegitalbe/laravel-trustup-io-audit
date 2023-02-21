<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogStatusesTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    /**
     * Mocking LogStatusCOntract.
     *
     * @return LogServiceContract|MockInterface
     */
    protected function mockLogStatusCOntract(): MockInterface
    {
        /** @var LogStatusCOntract */
        return $this->mockThis(LogStatusCOntract::class);
    }
    public function test_that_is_enabled_return_false_if_app_running_test()
    {
        $logStatus = app()->make(LogStatusContrat::class);
        $this->assertFalse($logStatus->isEnabled());
    }

    public function test_that_isEnabled_return_false_if_explicitly_disabled()
    {
        $logStatus = app()->make(LogStatusContrat::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $this->setPrivateProperty('isEnabled', false, $logStatus);
        $this->assertFalse($logStatus->isEnabled());
    }

    public function test_that_is_enabled_return_true_if_enable_in_test()
    {
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabled', true, $logStatus);
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        $this->assertTrue($logStatus->isEnabled());
    }

    public function test_that_it_can_mock()
    {

        /** @var LogStatusContrat */
        $logStatus = app()->make(LogStatusContrat::class);
        $mock = $logStatus->mock();
        /** @var LogServiceContract */
        $logService = app()->make(LogServiceContract::class);

        $this->assertInstanceOf(MockInterface::class, $mock);
        $this->assertEquals($mock, $logService);
    }


    public function test_that_it_can_enable()
    {
        $logstatus = $this->mockThis(LogStatus::class);
        $logstatus->shouldReceive("setIsEnabled")->once()->with(true)->andReturnSelf();
        $logstatus->shouldReceive("enable")->once()->withNoArgs()->passthru();

        $test = $logstatus->enable();
        $this->assertNull($test);
    }

    public function test_that_it_can_disable()
    {
        $logstatus = $this->mockThis(LogStatus::class);
        $logstatus->shouldReceive("setIsEnabled")->once()->with(false)->andReturnSelf();
        $logstatus->shouldReceive("disable")->once()->withNoArgs()->passthru();

        $test = $logstatus->disable();
        $this->assertNull($test);
    }

    public function test_that_set_is_enabled_can_set_static_property_is_enabled()
    {
        $logstatus = app()->make(LogStatus::class);
        $this->callPrivateMethod('setIsEnabled', $logstatus, false);
        $this->assertFalse($this->getPrivateProperty('isEnabled', $logstatus));
    }

    public function test_that_is_disabled_return_the_opposite_of_is_enable()
    {
        $logstatus = $this->mockThis(LogStatus::class);
        $logstatus->shouldReceive("isDisabled")->once()->withNoArgs()->passthru();
        $logstatus->shouldReceive("isEnabled")->once()->withNoArgs()->andReturnTrue();
        $isDisable = $logstatus->isDisabled();
        $this->assertFalse($isDisable);
    }

    public function test_that_set_is_enabled_in_test_can_set_static_property_is_enabled()
    {
        $logstatus = app()->make(LogStatus::class);
        $this->callPrivateMethod("setIsEnableInTests", $logstatus, true);
        $this->assertTrue($this->getPrivateProperty('isEnabledInTests', $logstatus));
    }
}

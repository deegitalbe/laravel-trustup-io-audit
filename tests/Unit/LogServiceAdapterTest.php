<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Mockery\MockInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use stdClass;

class LogServiceAdapterTest extends TestCase
{
    use InstallPackageTest, TestSuite;

    /**
     * Mocking LogServiceAdapter.
     * 
     * @return LogServiceAdapter|MockInterface
     */
    protected function mockLogServiceAdapter(): MockInterface
    {
        /** @var LogServiceAdapter */
        return $this->mockThis(LogServiceAdapter::class);
    }


    public function test_that_it_can_get_app_key()
    {
        $value = "test-key";
        $logServiceAdapter = $this->mockLogServiceAdapter();
        $logServiceAdapter->shouldReceive('getAppKey')->once()->withNoArgs()->passthru();

        $this->assertEquals($value, $logServiceAdapter->getAppKey());
    }


    public function test_that_it_can_get_responsible_id()
    {
        $user = new stdClass();
        $user->id = "2";
        $logServiceAdapter = $this->mockLogServiceAdapter();

        Auth::shouldReceive('user')->andReturn($user);
        $logServiceAdapter->shouldReceive('getResponsibleId')->once()->withNoArgs()->passthru();

        $this->assertEquals($user->id, $logServiceAdapter->getResponsibleId());
    }

    public function test_that_it_can_get_responsible_type()
    {
        $user = "user";
        $logServiceAdapter = $this->mockLogServiceAdapter();

        $logServiceAdapter->shouldReceive('getResponsibleType')->once()->withNoArgs()->passthru();

        $this->assertEquals($user, $logServiceAdapter->getResponsibleType());
    }


    public function test_that_it_can_get_account_uuid()
    {
        $null = null;
        $logServiceAdapter = $this->mockLogServiceAdapter();

        $logServiceAdapter->shouldReceive('getAccountUuid')->once()->withNoArgs()->passthru();

        $this->assertEquals($null, $logServiceAdapter->getAccountUuid());
    }


    public function test_that_it_can_get_impersonated_by()
    {
        $null = null;
        $logServiceAdapter = $this->mockLogServiceAdapter();

        $logServiceAdapter->shouldReceive('getImpersonatedBy')->once()->withNoArgs()->passthru();

        $this->assertEquals($null, $logServiceAdapter->getImpersonatedBy());
    }
}

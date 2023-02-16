<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;


use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class IsTrustupIoAuditRelatedModelTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;


    /**
     * Mocking User.
     *
     * @return User|MockInterface
     */
    protected function mockUser(): MockInterface
    {
        /** @var User */
        return $this->mockThis(User::class);
    }

    public function test_that_it_can_get_trustup_io_audit_related_model_id()
    {
        $class = $this->mockUser();
        $this->setPrivateProperty('uuid', "test", $class);
        $class->shouldReceive("getTrustupIoAuditModelId")->once()->withNoArgs()->passthru();
        $this->assertEquals("test", $class->getTrustupIoAuditModelId());
    }


    public function test_that_it_can_get_trustup_io_audit_related_model_type()
    {
        $class = $this->mockUser();
        $class->shouldReceive("getMorphClass")->once()->withNoArgs()->andReturn("app\\model\\test");
        $class->shouldReceive("getTrustupIoAuditModelType")->once()->withNoArgs()->passthru();
        $this->assertEquals("app-model-test", $class->getTrustupIoAuditModelType());
    }
}

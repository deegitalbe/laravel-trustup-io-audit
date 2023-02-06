<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;


use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Models\TrustupIoLogLoadingCallback;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationSubscriberContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Models\Relations\ExternalModelRelationSubscriber;
use SebastianBergmann\Type\VoidType;

class IsTrustupIoAuditRelatedModelWithRelationsTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    /**
     * Mocking UserWithRelations.
     * 
     * @return UserWithRelations|MockInterface
     */
    protected function mockUserWithRelations(): MockInterface
    {
        /** @var UserWithRelations */
        return $this->mockThis(UserWithRelations::class);
    }

    public function test_that_it_can_get_trustup_io_audit_log_column()
    {

        $class = $this->mockUserWithRelations();

        $class->shouldReceive('getTrustupIoAuditLogColumn')->once()->withNoArgs()->passthru();

        $this->assertEquals("trustup_io_audit_log_uuids", $class->getTrustupIoAuditLogColumn());
    }


    public function test_that_it_can_it_get_relation()
    {
        $class = $this->mockUserWithRelations();
        $ext = $this->mockThis(ExternalModelRelationContract::class);
        $callback = $this->mockThis(TrustupIoLogLoadingCallback::class);


        $class->shouldReceive('getTrustupIoAuditLogColumn')->once()->withNoArgs()->andReturn("trustup_io_audit_log_uuids");
        $class->shouldReceive('hasManyExternalModels')->once()->with($callback, "trustup_io_audit_log_uuids")->andReturn($ext);

        $class->shouldReceive('trustupIoAuditLogs')->once()->withNoArgs()->passthru();

        $this->assertEquals($ext, $class->trustupIoAuditLogs());
    }


    public function test_that_it_can_get_trustup_io_audit_logs_collection()
    {
        $class = $this->mockUserWithRelations();
        $ext = $this->mockThis(ExternalModelContract::class);

        $class->shouldReceive('getExternalModels')->once()->with("trustupIoAuditLogs")->andReturn(collect($ext));
        $class->shouldReceive('getTrustupIoAuditLogs')->once()->withNoArgs()->passthru();

        $this->assertEquals(collect($ext), $class->getTrustupIoAuditLogs());
    }

    public function test_that_it_can_initialize_trustup_io_audit_related_model_with_relations()
    {
        $class = $this->mockUserWithRelations();
        $extSubscriber = $this->mockThis(ExternalModelRelationSubscriberContract::class);
        $ext = $this->mockThis(ExternalModelRelationContract::class);


        $class->shouldReceive('getExternalModelRelationSubscriber')->once()->withNoArgs()->andReturn($extSubscriber);
        $class->shouldReceive('trustupIoAuditLogs')->once()->withNoArgs()->andReturn($ext);
        $class->shouldReceive('initializeIsTrustupIoAuditRelatedModelWithRelations')->once()->withNoArgs()->passthru();

        $extSubscriber->shouldReceive("register")->once()->with($ext)->andReturnSelf();

        $this->assertEquals(null, $class->initializeIsTrustupIoAuditRelatedModelWithRelations());
    }
}

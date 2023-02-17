<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Tests\traits\isUserWithRelated;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Observers\TrustupIoAuditRelatedObserver;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

class TrustupIoAuditRelatedObserverTest extends TestCase
{
    use InstallPackageTest, TestSuite, isUserWithRelated;

    /**
     * Mocking TrustupIoAuditRelatedObserver.
     *
     * @return TrustupIoAuditRelatedObserver|MockInterface
     */
    protected function mockTrustupIoAuditRelatedObserver(): MockInterface
    {
        /** @var TrustupIoAuditRelatedObserver */
        return $this->mockThis(TrustupIoAuditRelatedObserver::class);
    }

    /**
     * Mocking TrustupIoAuditRelatedModelContract.
     *
     * @return TrustupIoAuditRelatedModelContract|MockInterface
     */
    protected function mockTrustupIoAuditRelatedModelContract(): MockInterface
    {
        /** @var TrustupIoAuditRelatedModelContract */
        return $this->mockThis(TrustupIoAuditRelatedModelContract::class);
    }

    /**
     * Mocking LogService.
     *
     * @return LogService|MockInterface
     */
    protected function mockLogServiceContract(): MockInterface
    {
        /** @var LogServiceContract */
        return $this->mockThis(LogServiceContract::class);
    }


    public function test_that_it_can_observe_created_event()
    {
        $this->be(new User(["id" => 2]));
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $user = $this->createUser();
        $this->assertDatabaseHas('users', $user->getAttributes());
    }



    public function test_that_it_can_observe_updated_event()
    {
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $this->be(new User(["id" => 2]));
        $user = $this->createUser();
        $updated = User::find($user->id);
        $updated->update(["name" => "AHHAHAHA"]);
        $this->assertNotEquals($user->getAttributes()["name"], $updated->getAttributes()["name"]);
    }

    public function test_that_it_can_observe_deleted_event()
    {
        $this->be(new User(["id" => 2]));
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $user = $this->createUser();
        User::where('id', 1);
        $user->delete();
        $this->assertSoftDeleted('users', $user->getAttributes());
    }


    public function test_that_it_can_observe_restored_event()
    {
        $this->be(new User(["id" => 2]));
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $user = $this->createUser();
        User::where('id', $user->id)->delete();
        $restored = User::withTrashed()->find($user->id)->restore();
        $this->assertTrue($restored);
    }

    public function test_that_it_can_observe_forcedDelete_event()
    {
        $this->be(new User(["id" => 2]));
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $user = $this->createUser();
        User::where('id', $user->id)->forceDelete();
        $this->assertDeleted('users', $user->getAttributes());
    }


    // ADD MOCK OBSERVER CHECK CREATED ETC ON CREATE OF MODEL

    public function test_that_observer_can_trigger_event_created()
    {

        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $observer = $this->mockThis(TrustupIoAuditRelatedObserver::class);
        $observer->shouldReceive("created")->once()->withArgs(function (TrustupIoAuditRelatedModelContract $relatedModel) {
            return $relatedModel->name == "plop" && $relatedModel->email == "plop" && $relatedModel->password == "plop" && $relatedModel->uuid === "test";
        });
        $this->createUser();
    }



    public function test_that_observer_can_trigger_event_updated()
    {


        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);

        $this->be(new User(["id" => 2]));
        $user = $this->createUser();
        $observer = $this->mockThis(TrustupIoAuditRelatedObserver::class);

        $observer->shouldReceive("updated")->once()->withArgs(function (TrustupIoAuditRelatedModelContract $relatedModel) {
            return $relatedModel->name === "AHHAHAHA" && $relatedModel->email === "plop" && $relatedModel->password === "plop" && $relatedModel->uuid === "test";
        });
        $updated = User::find($user->id);
        $updated->update(["name" => "AHHAHAHA"]);
    }

    public function test_that_observer_can_trigger_event_soft_delete()
    {
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $this->be(new User(["id" => 2]));
        $user = $this->createUser();

        $observer = $this->mockThis(TrustupIoAuditRelatedObserver::class);
        $observer->shouldReceive("deleted")->once()->withArgs(function ($relatedModel) use ($user) {
            return $relatedModel->id == $user->id;
        });
        $deleted = User::find($user->id)->delete();
    }

    public function test_that_observer_can_trigger_event_restored()
    {
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $this->be(new User(["id" => 2]));
        $user = $this->createUser();
        $deleted = User::find($user->id)->delete();

        $observer = $this->mockThis(TrustupIoAuditRelatedObserver::class);
        $observer->shouldReceive("updated")->once()->withArgs(function ($relatedModel) use ($user) {
            return $relatedModel->id === $user->id;
        });
        $restored = User::where("id", $user->id)->withTrashed()->first()->restore();
    }


    public function test_that_observer_can_trigger_event_force_deleted()
    {
        $logStatus = app()->make(LogStatus::class);
        $this->setPrivateProperty('isEnabledInTests', true, $logStatus);
        $this->be(new User(["id" => 2]));
        $user = $this->createUser();

        $observer = $this->mockThis(TrustupIoAuditRelatedObserver::class);
        $observer->shouldReceive("deleted")->once()->withArgs(function ($relatedModel) use ($user) {
            return $relatedModel->id == $user->id;
        });
        User::find($user->id)->forceDelete();
    }

    public function test_that_it_does_not_trigger_relation_update_if_uuid_null()
    {
        $observer = app()->make(TrustupIoAuditRelatedObserver::class);
        $model = $this->mockThis(User::class, true);
        $uuid = null;
        $model->shouldNotReceive("trustupIoAuditLogs");
        $this->callPrivateMethod("addToRelated", $observer, $uuid, $model);
    }


    public function test_that_it_does_not_trigger_relation_update_if_not_implementing_relation_contract()
    {
        // $model = $this->createUser();
        $observer = app()->make(TrustupIoAuditRelatedObserver::class);
        // DO PARTIALS IF SOMETHING CHELOU
        $model = $this->mockThis(User::class, true);
        $uuid = "uuid";
        $model->shouldNotReceive("trustupIoAuditLogs");
        $this->callPrivateMethod("addToRelated", $observer, $uuid, $model);
    }

    public function test_that_it_does_trigger_relation_update_if_implementing_relation_contract()
    {
        // $model = $this->createUser();
        $observer = app()->make(TrustupIoAuditRelatedObserver::class);
        $model = $this->mockThis(UserWithRelations::class, true);
        $relation = $this->mockThis(ExternalModelRelationContract::class);

        $uuid = "uuid";
        // $model->shouldReceive("withoutEvents")->passthru();
        $model->shouldReceive("trustupIoAuditLogs")->once()->withNoArgs()->andReturn($relation);
        $relation->shouldReceive("addToRelatedModelsByIds")->once()->with($uuid)->andReturnSelf();
        $this->callPrivateMethod("addToRelated", $observer, $uuid, $model);
    }
}

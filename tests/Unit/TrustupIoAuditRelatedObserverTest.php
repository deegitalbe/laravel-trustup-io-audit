<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use stdClass;
use Mockery\MockInterface;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Observers\TrustupIoAuditRelatedObserver;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;

class TrustupIoAuditRelatedObserverTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

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
        $user = new stdClass();
        $user->id = "2";
        Bus::fake();

        Auth::shouldReceive('user')->andReturn($user);
        $user =  User::create([
            'name' => 'Titel',
            "email" => "test@test",
            "password" => "test"
        ]);
        Bus::assertDispatched(CallLogEndpoint::class);
        $this->assertDatabaseHas('users', $user->getAttributes());
    }



    public function test_that_it_can_observe_updated_event()
    {
        $user = new stdClass();
        $user->id = "2";
        Bus::fake();
        $this->migrateSoftDelete();
        Auth::shouldReceive('user')->andReturn($user);
        $user = User::create([
            'id' => 1,
            'name' => 'Titel',
            "email" => "test@test",
            "password" => "test"
        ]);
        $updated = User::where('id', 1);
        $updated->update(["name" => "test"]);
        $updated = User::where('id', 1)->first();
        Bus::assertDispatched(CallLogEndpoint::class);
        $this->assertNotEquals($user->getAttributes()["name"], $updated->getAttributes()["name"]);
    }



    public function test_that_it_can_observe_deleted_event()
    {

        $user = new stdClass();
        $user->id = "2";
        Bus::fake();
        $this->migrateSoftDelete();
        Auth::shouldReceive('user')->andReturn($user);
        $user = User::create([
            'id' => 1,
            'name' => 'Titel',
            "email" => "test@test",
            "password" => "test"
        ]);
        User::where('id', 1);
        $user->delete();
        Bus::assertDispatched(CallLogEndpoint::class);
        $this->assertSoftDeleted('users', $user->getAttributes());
    }


    public function test_that_it_can_observe_restored_event()
    {
        $user = new stdClass();
        $user->id = "2";
        Bus::fake();
        $this->migrateSoftDelete();
        Auth::shouldReceive('user')->andReturn($user);
        $user = User::create([
            'id' => 1,
            'name' => 'Titel',
            "email" => "test@test",
            "password" => "test",
            "deleted_at" => now()
        ]);
        $user = User::where('id', 1);
        $user->delete();
        $restored = User::withTrashed()->find(1)->restore();

        Bus::assertDispatched(CallLogEndpoint::class);
        $this->assertTrue($restored);
    }

    public function migrateSoftDelete()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }



    public function test_that_it_can_observe_forcedDelete_event()
    {
        $user = new stdClass();
        $user->id = "2";
        Bus::fake();
        $this->migrateSoftDelete();
        Auth::shouldReceive('user')->andReturn($user);
        $user = User::create([
            'id' => 1,
            'name' => 'Titel',
            "email" => "test@test",
            "password" => "test",
            "deleted_at" => now()
        ]);
        User::where('id', 1)
            ->forceDelete();
        Bus::assertDispatched(CallLogEndpoint::class);
        $this->assertDeleted('users', $user->getAttributes());
    }
}

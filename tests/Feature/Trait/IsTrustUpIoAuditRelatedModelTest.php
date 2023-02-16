<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;

use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Mockery\MockInterface;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\UserWithRelations;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;

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


    public function test_that_it_can_save_log_with_related_model_store_model()
    {
        Http::fake();
        $logStatus = app()->make(LogStatus::class);
        /** set auth user for getResponsible id  */
        $this->be(new User(["id" => 2]));
        /** Enable log in test */
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        /** Create User */
        $user = $this->createUser();
        Http::assertSentCount(1);
        /** Observer is trigger -> created -> storeModel (Generate an uuid storeLogRequest) -> storeRequest -> job -> store (return uuid from storeLogRequest) */
        // What can I assert ? can't get the uuid.
        // Can't check the real response as we do not really send request.
    }


    // public function test_that_it_can_save_log_with_related_model_from_array()
    // {
    //     Http::response(["log_uuid" => "test"], 200);
    //     $logStatus = app()->make(LogStatus::class);
    //     $this->be(new User(["id" => 2]));
    //     $logStatus->enable();
    //     $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
    //     $user = $this->createUser();
    //     /** @var StoreLogRequest */
    //     $request = app()->make(StoreLogRequest::class);
    //     $request->fromArray($user->getAttributes())->setEventName("created");

    //     /** @var LogEndpoint */
    //     $endpoint = app()->make(LogEndpoint::class);
    //     $this->assertEquals($request->getUuid(), $endpoint->store($request));
    // }

    protected function createUser(): User
    {
        $user = new User();
        return $user->create(["id" => random_int(1, 30), "name" => "plop", "email" => "plop", "password" => "plop", "uuid" => "test"]);
    }
}

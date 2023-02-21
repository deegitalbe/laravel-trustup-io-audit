<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;

use Mockery\MockInterface;
use Illuminate\Support\Facades\Http;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs\LogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogService;
use Deegitalbe\LaravelTrustupIoAudit\Tests\traits\isUserWithRelated;

class IsTrustupIoAuditRelatedModelTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase, isUserWithRelated;


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
        $this->migrateWithourRelation();
        $logStatus = app()->make(LogStatus::class);
        /** set auth user for getResponsible id  */
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        // Http::fake();

        /** Create User */
        $this->be(new User(["id" => 2]));
        $endpoint = $this->mockThis(LogEndpoint::class);

        $endpoint->shouldReceive("store")->withArgs(function (StoreLogRequestContract $storeLogRequest) {
            return $storeLogRequest->getModelId() === 'test' && $storeLogRequest->getModelType() === "deegitalbe-laraveltrustupioaudit-tests-unit-models-user";
        })->once();
        $user = $this->createUser();
    }


    public function test_that_it_can_save_log_with_related_model_from_array()
    {
        $this->migrateWithourRelation();

        // $this->be(new User(["id" => 2]));
        $user = $this->createUser()->getAttributes();
        $user["payload"] = json_encode($user);
        $user["responsible_id"] = "1";
        $user["responsible_type"] = "test";
        $user["app_key"] = 'test-key';

        /** Enable log in test */
        $logStatus = app()->make(LogStatus::class);
        $this->callPrivateMethod('setIsEnableInTests', $logStatus, true);
        // Http::fake();

        $endpoint = $this->mockThis(LogEndpointContract::class);
        $endpoint->shouldReceive("store")->once()->withArgs(function (StoreLogRequestContract $storeLogRequest) {
            dd($storeLogRequest);
            return $storeLogRequest->getEventName() == "created" && $storeLogRequest->getAppKey() == "test-key";
        });

        /** @var LogService */
        $logService = app()->make(LogService::class);
        $logService->storeAttributes("created", $user);
    }
}

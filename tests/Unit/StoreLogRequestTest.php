<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class StoreLogRequestTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_instanciate_service_provider()
    {
        $this->assertTrue(true);
    }

    public function test_it_can_set_responsible_id()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setResponsibleId($str));
        $this->assertEquals($str, $this->getPrivateProperty('responsibleId', $model));
    }

    public function test_it_can_set_responsible_type()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setResponsibleType($str));
        $this->assertEquals($str, $this->getPrivateProperty('responsibleType', $model));
    }


    public function test_it_can_set_app_key()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setAppKey($str));
        $this->assertEquals($str, $this->getPrivateProperty('appKey', $model));
    }

    public function test_it_can_set_model_id()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setModelId($str));
        $this->assertEquals($str, $this->getPrivateProperty('modelId', $model));
    }

    public function test_it_can_set_model_type()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setModelType($str));
        $this->assertEquals($str, $this->getPrivateProperty('modelType', $model));
    }

    public function test_it_can_set_payload()
    {
        $str = ["key" => "3"];
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setPayload($str));
        $this->assertEquals($str, $this->getPrivateProperty('payload', $model));
    }

    public function test_it_can_set_account_uuid()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setAccountUuid($str));
        $this->assertEquals($str, $this->getPrivateProperty('accountUuid', $model));
    }

    public function test_it_can_set_event_name()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setEventName($str));
        $this->assertEquals($str, $this->getPrivateProperty('eventName', $model));
    }

    public function test_it_can_set_logged_at()
    {
        $carbon = Carbon::now();
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setLoggedAt($carbon));
        $this->assertEquals($carbon, $this->getPrivateProperty('loggedAt', $model));
    }

    public function test_it_can_set_impersonated_by()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setImpersonatedBy($str));
        $this->assertEquals($str, $this->getPrivateProperty('impersonatedBy', $model));
    }

    public function test_it_can_set_log_fromArray()
    {
        $attributes = [
            "responsible_id" => "test",
            "responsible_type" => "test",
            "app_key" => "test",
            "model_id" => "test",
            "model_type" => "test",
            "payload" => '["key" => "test"]',
            "account_uuid" => "test",
            "event_name" => "test",
            "logged_at" => Carbon::now(),
            "impersonated_by" => "test",
        ];
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->fromArray($attributes));
    }

    public function test_it_can_parse_to_carbon()
    {
        $carbon = "2018-09-15 10:35:00";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertInstanceOf(Carbon::class, $this->callPrivateMethod("parseToCarbon", $model, $carbon));
    }

    public function test_it_can_return_array()
    {
        $str = 'test';
        $arr = ["key" => "test"];
        $carbon = Carbon::now();
        $model = app()->make(StoreLogRequestContract::class);

        $this->setPrivateProperty('responsibleId', $str, $model);
        $this->setPrivateProperty('responsibleType', $str, $model);
        $this->setPrivateProperty('appKey', $str, $model);
        $this->setPrivateProperty('modelId', $str, $model);
        $this->setPrivateProperty('modelType', $str, $model);
        $this->setPrivateProperty('payload', $arr, $model);
        $this->setPrivateProperty('accountUuid', $str, $model);
        $this->setPrivateProperty('eventName', $str, $model);
        $this->setPrivateProperty('loggedAt', $carbon, $model);
        $this->setPrivateProperty('impersonatedBy', $str, $model);


        $this->assertArrayHasKey("uuid", $model->toArray());
    }


    public function test_that_it_can_get_responsible_id()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('responsibleId', $str, $model);
        $this->assertEquals($str, $model->getResponsibleId());
    }

    public function test_that_it_can_get_responsible_type()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('responsibleType', $str, $model);
        $this->assertEquals($str, $model->getResponsibleType());
    }

    public function test_that_it_can_get_app_key()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('appKey', $str, $model);
        $this->assertEquals($str, $model->getAppKey());
    }

    public function test_that_it_can_get_model_id()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('modelId', $str, $model);
        $this->assertEquals($str, $model->getModelId());
    }

    public function test_that_it_can_get_model_type()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('modelType', $str, $model);
        $this->assertEquals($str, $model->getModelType());
    }

    public function test_that_it_can_get_payload()
    {
        $str = ["key" => "test"];
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('payload', $str, $model);
        $this->assertEquals($str, $model->getPayload());
    }

    public function test_that_it_can_get_Account_uuid()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('accountUuid', $str, $model);
        $this->assertEquals($str, $model->getAccountUuid());
    }

    public function test_that_it_can_get_event_name()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('eventName', $str, $model);
        $this->assertEquals($str, $model->getEventName());
    }

    public function test_that_it_can_get_logged_at()
    {
        $str = Carbon::now();
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('loggedAt', $str, $model);
        $this->assertEquals($str, $model->getLoggedAt());
    }

    public function test_that_it_can_get_impersonated_by()
    {
        $str = "test";
        $model = app()->make(StoreLogRequestContract::class);
        $this->setPrivateProperty('impersonatedBy', $str, $model);
        $this->assertEquals($str, $model->getImpersonatedBy());
    }

    public function test_it_can_set__request_uuid()
    {
        $str = "3";
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals($model, $model->setUuid($str));
        $this->assertEquals($str, $this->getPrivateProperty('uuid', $model));
    }

    public function test_it_can_get__request_ruuid()
    {

        $model = app()->make(StoreLogRequestContract::class);
        $this->assertEquals(
            $model->getUuid(),
            $model->getUuid()
        );
    }
    public function test_that_uuid_is_returned_even_if_not_defined()
    {
        $model = app()->make(StoreLogRequestContract::class);
        $this->assertTrue(is_string($model->getUuid()));
    }
}

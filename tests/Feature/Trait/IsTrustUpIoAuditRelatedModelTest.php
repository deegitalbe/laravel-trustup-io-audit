<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Feature\Trait;


use Mockery\MockInterface;
use Illuminate\Support\Facades\Cache;
use Henrotaym\LaravelTestSuite\TestSuite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Deegitalbe\LaravelTrustupIoAudit\Tests\TestCase;
use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\Models\User;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;

class IsTrustupIoAuditRelatedModelTest extends TestCase
{
    use InstallPackageTest, TestSuite, RefreshDatabase;

    public function test_that_it_cant_boot_trustup_io_audit_related_model_in_env_test()
    {
        // Test package facade.
        $user = new User();
        $user->create(["name" => "plop", "email" => "plop", "password" => "plop"]);
        $this->assertNull($user->bootIsTrustupIoAuditRelatedModel());
    }

    public function test_that_it_cant_boot_trustup_io_audit_related_model_in_env_staging()
    {
        $user = new User();
        $user->create(["name" => "plop", "email" => "plop", "password" => "plop"]);
        $this->assertNull($user->bootIsTrustupIoAuditRelatedModel());
        $this->assertTrue(Package::getConfig("app_env") == "staging");
    }

    public function test_that_it_cant_boot_trustup_io_audit_related_model_if_audit_log_enabled_is_enabled()
    {

        $user = new User();
        $user->create(["name" => "plop", "email" => "plop", "password" => "plop"]);
        $this->assertNull($user->bootIsTrustupIoAuditRelatedModel());
        $this->assertTrue(Package::getConfig("audit_log_enabled") == true);
    }

    public function test_that_it_cant_boot_trustup_io_audit_related_model_if_audit_log_enabled_is_disabled()
    {
        $user = new User();
        $user->create(["name" => "plop", "email" => "plop", "password" => "plop"]);
        $this->assertNull($user->bootIsTrustupIoAuditRelatedModel());
        $this->assertTrue(Package::getConfig("audit_log_enabled") == false);
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests;

use Deegitalbe\LaravelTrustupIoAudit\Package;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;
use Deegitalbe\LaravelTrustupIoAudit\Providers\LaravelTrustupIoAuditServiceProvider;

class TestCase extends VersionablePackageTestCase
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }

    public function getServiceProviders(): array
    {
        return [
            LaravelTrustupIoAuditServiceProvider::class
        ];
    }
}

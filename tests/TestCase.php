<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests;

use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit;
use Henrotaym\LaravelApiClient\Providers\ClientServiceProvider;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;
use Deegitalbe\LaravelTrustupIoAudit\Providers\LaravelTrustupIoAuditServiceProvider;

class TestCase extends VersionablePackageTestCase
{
    public static function getPackageClass(): string
    {
        return TrustupIoAudit::class;
    }

    public function getServiceProviders(): array
    {

        return [
            LaravelTrustupIoAuditServiceProvider::class,
            ClientServiceProvider::class,
        ];
    }

    public function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    protected function getEnvironmentSetUp($app)
    {
        # Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}

<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests;

use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit;
use Henrotaym\LaravelApiClient\Providers\ClientServiceProvider;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;
use Deegitalbe\LaravelTrustupIoAudit\Providers\LaravelTrustupIoAuditServiceProvider;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Providers\LaravelTrustupIoExternalModelRelationsServiceProvider;
use Henrotaym\LaravelTrustupIoIpClient\Providers\LaravelTrustupIoIpClientServiceProvider;

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
            LaravelTrustupIoExternalModelRelationsServiceProvider::class,
            LaravelTrustupIoIpClientServiceProvider::class,
            ClientServiceProvider::class,
        ];
    }


    // DEFINE TRAIT WITH MIGRATIONS TO TEST THAT NEED IT
    // TEST FEATURE OF BOTH TRAIT RELATED MODEL
    // BOOT UNITAIRE TEST
    public function defineDatabaseMigrations()
    {
        // $this->loadLaravelMigrations(['--database' => 'testbench']);
        // $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    protected function getEnvironmentSetUp($app)
    {
        // $app['config']->set('database.default', 'testbench');
        // $app['config']->set('database.connections.testbench', [
        //     'driver'   => 'sqlite',
        //     'database' => ':memory:',
        //     'prefix'   => '',
        // ]);
        include_once __DIR__ . '/Unit/database/migrations/create_users_table.php';
        include_once __DIR__ . '/Unit/database/migrations/create_users_with_relations_table.php';
    }
}

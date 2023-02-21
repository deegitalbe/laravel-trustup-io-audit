<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Facades;

use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit as Underlying;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

/**
 * @method static void disable() Disabling logging.
 * @method static void enable() Enabling logging.
 * @method static ?string storeAttributes(string $eventName, array $attributes) Creating a log manually using given attributes.
 * @method static ?string storeRequest(\Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract $request) Creating a log manually using given request.
 * @method static string getUrl() Getting audit log url.
 * @method static \Mockery\MockInterface mock() Reactivating audit log in tests to perform assertions.
 *
 * @see \Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit
 */
class TrustupIoAudit extends VersionablePackageFacade
{
    public static function getPackageClass(): string
    {
        return Underlying::class;
    }
}

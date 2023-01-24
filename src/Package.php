<?php
namespace Deegitalbe\LaravelTrustupIoAudit;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\PackageContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;

class Package extends VersionablePackage implements PackageContract
{
    public static function prefix(): string
    {
        return "versioning_package_template";
    }
}
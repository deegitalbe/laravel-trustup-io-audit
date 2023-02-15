<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Facades;

use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit as Underlying;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

class TrustupIoAudit extends VersionablePackageFacade
{
    public static function getPackageClass(): string
    {
        return Underlying::class;
    }
}

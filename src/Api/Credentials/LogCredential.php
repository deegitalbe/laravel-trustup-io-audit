<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Credentials;

use Henrotaym\LaravelApiClient\JsonCredential;
use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\LogStatus;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class LogCredential extends JsonCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $status = app()->make(LogStatus::class);
        $request->setBaseUrl(Package::getConfig($status->getAppUrl()) . '/api');
    }
}

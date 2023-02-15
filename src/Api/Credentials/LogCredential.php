<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Credentials;

use Henrotaym\LaravelApiClient\JsonCredential;
use Deegitalbe\LaravelTrustupIoAudit\TrustupIoAudit;
use Deegitalbe\LaravelTrustupIoAudit\Facades\Package;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class LogCredential extends JsonCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $facade = app()->make(TrustupIoAudit::class);
        $request->setBaseUrl(Package::getConfig($facade->getApiUrl()) . '/api');
    }
}

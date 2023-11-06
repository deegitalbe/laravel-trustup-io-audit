<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Credentials;

use Henrotaym\LaravelApiClient\JsonCredential;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class LogCredential extends JsonCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $request->setBaseUrl(TrustupIoAudit::getUrl() . '/api');
    }
}

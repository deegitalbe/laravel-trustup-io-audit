<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Credentials;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\JsonCredential;

class LogCredential extends JsonCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $request->setBaseUrl(env('TRUSTUP_IO_AUDIT_URL') . '/api');
    }
}

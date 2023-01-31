<?php

return [
    /** your adapter should implement LogAdapterContract */
    'adapter' => CustomAdapter::class,
    'app_key' => env("TRUSTUP_APP_KEY")
];
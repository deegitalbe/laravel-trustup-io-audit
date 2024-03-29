# deegitalbe/laravel-trustup-io-audit

## Installation

```shell
sail composer require deegitalbe/laravel-trustup-io-audit
```

## .env (non-mandatory)

```shell
TRUSTUP_IO_AUDIT_URL=
```

## 🙇 Acknowledgements

Please add this column to your migration/model. It represent your relation.

Feel free to overide it's name if it enter in conflict with your project.

```shell
trustup_io_audit_log_uuids
```

##

## 🛠️ Default utilisation

```shell
<?php

class TicketExample extends AbstractModel implements TrustupIoAuditRelatedModelContract
{
    use IsDefaultTrustupIoAuditRelatedModel;

    // The trait define already all necessary methods you will need to make your logs
    // By default it will take all attributes on your model like below 
        # public function getTrustupIoAuditPayload(): array
        # {
        #     return $this->getAttributes();
        # }
}

```

##

## 🛠️ You can also set your custom attributes

```shell
<?php

class TicketExample extends AbstractModel implements TrustupIoAuditRelatedModelContract

{
    use IsTrustupIoAuditRelatedModel;

    public function getTrustupIoAuditPayload(): array
    {
        // this will add your custom_attributes in your log payload for your current model.
        // It needs to return en array as the return type specify.
        return [
            $this->custom_attributes
            ];
    }
}

```

##

## 🛠️ Default implementation with relation

### Refer to [laravel-trustup-io-external-model-relation](https://github.com/deegitalbe/laravel-trustup-io-external-model-relations#readme) if you need more documentation on how relations work. Here You will have to define Necessary methods to retrieve your logs.

```shell
<?php

class TicketExample extends AbstractModel implements TrustupIoAuditRelatedModelWithRelationsContract
{
    use IsTrustupIoAuditRelatedModelWithRelations, IsExternalModelRelatedModel;

    // By default the relation name is set to trustupIoAuditLogs.

    public function getTrustupIoAuditPayload(): array
    {
        // here you can set all attributes that you want to log for your model
        // It needs to return en array as the return type specify.
        return $this->getAttributes();
    }
}

```

##


##

## 🛠️ Custom implementation with relation

### Refer to [laravel-trustup-io-external-model-relation](https://github.com/deegitalbe/laravel-trustup-io-external-model-relations#readme) if you need more documentation on how relations work.
## Preparing your model.

```shell
<?php

class TicketExample extends AbstractModel implements TrustupIoAuditRelatedModelContract
{
    use IsTrustupIoAuditRelatedModel, IsExternalModelRelatedModel;

    /**
     * Getting external relation names.
     *
     * @return array<int, string>
     */
    public function getExternalRelationNames(): array
    {
        return [
            'trustupIoAuditLogs'
        ];
    }

    public function getTrustupIoAuditLogColumn(): string
    {
        return 'trustup_io_audit_log_uuids';
    }

    public function trustupIoAuditLogs(): ExternalModelRelationContract
    {
        return $this->hasManyExternalModels(app()->make(TrustupIoLogLoadingCallback::class), $this->getTrustupIoAuditLogColumn());
    }

    /** @return Collection<int, ExternalModelContract> */
    public function getTrustupIoAuditLogs(): Collection
    {
        return $this->getExternalModels('trustupIoAuditLogs');
    }

    public function getTrustupIoAuditPayload(): array
    {
        // here you can set all attributes that you want to log for your model
        // It needs to return en array as the return type specify.
        return $this->getAttributes();
    }
}

```

## 🛠️ Exposing your models by creating a resource

You can use a predefined ressource within the package for your logs.

```shell
<?php

namespace App\Http\Resources;

use Deegitalbe\LaravelTrustupIoAudit\Resources\LogResource;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Traits\Resources\IsExternalModelRelatedResource;

class TicketExampleResource
{
    use IsExternalModelRelatedResource;


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'created_at' => $this->created_at,
            'logs' => LogResource::collection($this->whenExternalRelationLoaded('trustupIoAuditLogs')),
        ];
    }
}
```

##

## 🙇 🛠️ Adapter config publish.

Overide it if necessary as said below

##

```shell
sail artisan vendor:publish --provider="Deegitalbe\LaravelTrustupIoAudit\Providers\LaravelTrustupIoAuditServiceProvider" --tag="config"
```

## 🛠️ Default Adapter config.

By default the config use the package Adapter to set some attributes.

If you wish to make your own adapter you can overide it in the config and you should implements the LogServiceAdapterContract.

##

```shell
<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Facades\TrustupIoAudit;

class LogServiceAdapter implements LogServiceAdapterContract
{
    /** Application key */
    public function getAppKey(): string
    {
        return TrustupIoAudit::getConfig("app_key");
    }

    /** Responsible identifier */
    public function getResponsibleId(): string
    {
        return auth()->id();
    }

    /** type of the responsible */
    public function getResponsibleType(): string
    {
        return 'user';
    }

    /** account identifier */
    public function getAccountUuid(): ?string
    {
        return null;
    }
    /** Case the log was impersonated by */
    public function getImpersonatedBy(): ?string
    {
        return null;
    }
}
```

## ⚡ Eager load collections

Only one request will be performed even if you load multiple relations

```shell
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        return TicketExampleResource::collection(TicketExample::all()->loadExternalRelations('trustupIoAuditLogs'));
    }
}
```

## ⚡⚡ Migration relation trait.

By default the column is set to trustup_io_audit_log_uuids but feel free to overide it.

```shell
<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Tests\Unit\database\migrations;

use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Traits\TrustupioAuditRelatedMigrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    use TrustupioAuditRelatedMigrations;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        $this->addAUditLogColumn('users', 'trustup_io_audit_log_uuids');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        // $this->removeAuditLogColumn('users', 'trustup_io_audit_log_uuids');
    }
}
```

## ⚡⚡⚡ TrustupIoAudit facade for.

Available methods on the facade.

```shell

    public static function prefix(): string
    {
        return "laravel-trustup-io-audit";
    }

    /**
    * Mock laravel audit log.
    * Enabling logging during tests.
    */
    public function mock(): MockInterface
    {
        return $this->logStatus->mock();
    }

    /**
     * Disable Logging
     */
    public function disable(): void
    {
        $this->logStatus->disable();
    }

    /**
     * Enable Logging
     */
    public function enable(): void
    {
        $this->logStatus->enable();
    }

    /**
     * Store given attributes as log manually.
     */
    public function storeAttributes(string $eventName, array $attributes): ?string
    {
        return $this->logService->storeAttributes($eventName, $attributes);
    }

     /**
     * Store given requests as log manually.
     */
    public function storeRequest(StoreLogRequestContract $request): ?string
    {
        return $this->logService->storeRequest($request);
    }

```

## ⚡⚡⚡⚡ Note by default the package can guess on wich API it need to make request.

So you don't need to specify any url but just your environement.

```shell
<?php

namespace Deegitalbe\LaravelTrustupIoAudit;

...

    public function getUrl(): string
    {
        if ($environmentUrl = env("TRUSTUP_IO_AUDIT_URL")) return $environmentUrl;
        if (app()->environment("staging")) return "https://staging.audit.trustup.io";
        if (app()->environment("production")) return "https://audit.trustup.io";

        return "trustup-io-audit";
    }
```

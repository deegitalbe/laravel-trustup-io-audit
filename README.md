# deegitalbe/laravel-trustup-io-audit

## Installation

```shell
./composer install deegitalbe/laravel-trustup-io-audit
```

## .env

```shell
TRUSTUP_IO_AUDIT_URL=
```

## 🙇 Acknowledgements

Please add this column to your migration/model. It represent your relation.

Feel free to overide it's name if it enter in conflict with your project.

```shell
trustup_io_audit_log_uuids
```

## 🛠️ How to implements with relational model

```shell
<?php

namespace App\Models;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelWithRelationsContract;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModelWithRelations;
use Deegitalbe\LaravelTrustupIoModelCommons\Models\AbstractModel;

class TicketExample extends AbstractModel implements TrustupIoAuditRelatedModelWithRelationsContract
{
    use IsTrustupIoAuditRelatedModelWithRelations;

    public function getTrustupIoAuditPayload(): array
    {
        return $this->getAttributes();
    }
}

```

## 🛠️ Basic implementation without relational Model

### Refer to [laravel-trustup-io-external-model-relation](https://github.com/deegitalbe/laravel-trustup-io-external-model-relations#readme) if you need more documentation on how relations work.

```shell
<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoModelCommons\Models\AbstractModel;
use Deegitalbe\LaravelTrustupIoAudit\Models\IsTrustupIoAuditRelatedModel;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Traits\Models\IsExternalModelRelatedModel;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

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
        return $this->getAttributes();
    }
}

```

## Exposing your models by creating a resource

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

To disable the log during your test you can simply do as below.

```shell
    TrustupIoAudit::mock();

    /**
     * Create User without triggering observer.
     */

     User::create(["name"=> "test"]);



```

## ⚡⚡⚡⚡ Note by default the package can guess on wich API it need to make request.

So you don't need to specify any url but just you environement.

```shell
<?php

namespace Deegitalbe\LaravelTrustupIoAudit;

...

  public function getApiUrl(): string
    {
        if (app()->environment('TRUSTUP_IO_AUDIT_URL')) return app()->environment('TRUSTUP_IO_AUDIT_URL');
        if ($this->getEnv() === "staging") return  "staging-trustup-io-audit";
        if ($this->getEnv() === "local") return  "trustup-io-audit";
        if ($this->getEnv() === "testing") return  "trustup-io-audit";
        if ($this->getEnv() === "production") return  "production-staging-trustup-io-audit";
    }
```

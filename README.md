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

Please add this column to your migration/model. It represent your relation.\_\_

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

class PostResource extends ExternalModelRelatedResource
{

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

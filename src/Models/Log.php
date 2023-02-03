<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;

class Log extends ExternalModelContract implements LogContract
{

    protected string $responsibleId;

    protected string $responsibleType;

    protected ?string $appKey;

    protected ?string $modelId;

    protected ?string $modelType;

    protected ?array  $payload;

    protected ?string $accountUuid;

    protected string $eventName;

    protected Carbon $loggedAt;

    protected ?string $impersonatedBy;

    protected ?string $imporsonatedBy;

    protected array $cryptKeys;

    protected string $uuid;

    protected int $id;
    
    /** @return static */
    public function setResponsibleId(?string $responsibleId): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setResponsibleType(?string $responsibleType): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setAppKey(?string $appKey): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setModelId(?string $modelId): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setModelType(?string $modelType): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setPayload(?array $payload): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setAccountUuid(?string $accountUuid): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setEventName(string $eventName): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setLoggedAt(?Carbon $loggedAt = null): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setImpersonatedBy(?string $impersonatedBy): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setId(int $id): LogContract
    {
        return $this;
    }

    /** @return static */
    public function setUuid(?string $uuid): LogContract
    {
        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getResponsibleId(): ?string
    {
        return $this->responsibleId;
    }

    public function getResponsibleType(): ?string
    {
        return $this->responsibleType;
    }

    public function getAppKey(): ?string
    {
        return $this->appKey;
    }

    public function getModelId(): ?string
    {
        return $this->modelId
    }

    public function getModelType(): ?string
    {
        return $this->modelType;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }

    public function getAccountUuid(): ?string
    {
        return $this->accountUuid;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getLoggedAt(): Carbon
    {
        return $this->loggedAt;
    }

    public function getImpersonatedBy(): ?string
    {
        return $this->impersonatedBy;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

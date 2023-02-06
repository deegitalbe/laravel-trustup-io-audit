<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;

class Log implements LogContract
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

    protected string $uuid;

    protected int $id;

    /** @return static */
    public function setResponsibleId(?string $responsibleId): LogContract
    {
        $this->responsibleId = $responsibleId;
        return $this;
    }

    /** @return static */
    public function setResponsibleType(?string $responsibleType): LogContract
    {
        $this->responsibleType = $responsibleType;
        return $this;
    }

    /** @return static */
    public function setAppKey(?string $appKey): LogContract
    {
        $this->appKey = $appKey;
        return $this;
    }

    /** @return static */
    public function setModelId(?string $modelId): LogContract
    {
        $this->modelId = $modelId;
        return $this;
    }

    /** @return static */
    public function setModelType(?string $modelType): LogContract
    {
        $this->modelType = $modelType;
        return $this;
    }

    /** @return static */
    public function setPayload(?array $payload): LogContract
    {
        $this->payload = $payload;
        return $this;
    }

    /** @return static */
    public function setAccountUuid(?string $accountUuid): LogContract
    {
        $this->accountUuid = $accountUuid;
        return $this;
    }

    /** @return static */
    public function setEventName(string $eventName): LogContract
    {
        $this->eventName = $eventName;
        return $this;
    }

    /** @return static */
    public function setLoggedAt(?Carbon $loggedAt = null): LogContract
    {
        $this->loggedAt = $loggedAt;
        return $this;
    }

    /** @return static */
    public function setImpersonatedBy(?string $impersonatedBy): LogContract
    {
        $this->impersonatedBy = $impersonatedBy;
        return $this;
    }

    /** @return static */
    public function setId(int $id): LogContract
    {
        $this->id = $id;
        return $this;
    }

    /** @return static */
    public function setUuid(?string $uuid): LogContract
    {
        $this->uuid = $uuid;
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
        return $this->modelId;
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

    public function getExternalRelationIdentifier(): string|int
    {
        return $this->getUuid() ?? $this->getId();
    }

    public function fromArray(array $attributes): LogContract
    {
        $this->setId($attributes["id"]);
        $this->setUuid($attributes["uuid"]);
        $this->setEventName($attributes["event_name"]);
        $this->setResponsibleId($attributes["responsible_id"] ?? null);
        $this->setResponsibleType($attributes["responsible_type"] ?? null);
        $this->setAppKey($attributes["app_key"] ?? null);
        $this->setModelId($attributes["model_id"] ?? null);
        $this->setModelType($attributes["model_type"] ?? null);
        $this->setPayload($attributes["payload"] ?? null);
        $this->setLoggedAt($this->parseToCarbon($attributes["logged_at"]) ?? null);
        $this->setAccountUuid($attributes["account_uuid"] ?? null);
        $this->setImpersonatedBy($attributes["impersonated_by"] ?? null);
        return $this;
    }

    public function parseToCarbon(string $dateString): Carbon
    {
        return Carbon::parse($dateString);
    }
}

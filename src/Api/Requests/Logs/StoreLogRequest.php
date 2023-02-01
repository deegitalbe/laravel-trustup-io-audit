<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;


class StoreLogRequest implements StoreLogRequestContract
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



    /** @return static */
    public function setResponsibleId(?string $responsibleId): StoreLogRequestContract
    {
        $this->responsibleId = $responsibleId;
        return $this;
    }

    /** @return static */
    public function setResponsibleType(?string $responsibleType): StoreLogRequestContract
    {
        $this->responsibleType = $responsibleType;
        return $this;
    }

    /** @return static */
    public function setAppKey(?string $appKey): StoreLogRequestContract
    {
        $this->appKey = $appKey;
        return $this;
    }

    /** @return static */
    public function setModelId(?string $modelId): StoreLogRequestContract
    {
        $this->modelId = $modelId;
        return $this;
    }

    /** @return static */
    public function setModelType(?string $modelType): StoreLogRequestContract
    {
        $this->modelType = $modelType;
        return $this;
    }

    /** @return static */
    public function setPayload(?array $payload): StoreLogRequestContract
    {
        $this->payload = $payload;
        return $this;
    }

    /** @return static */
    public function setAccountUuid(?string $accountUuid): StoreLogRequestContract
    {
        $this->accountUuid = $accountUuid;
        return $this;
    }

    /** @return static */
    public function setEventName(string $eventName): StoreLogRequestContract
    {
        $this->eventName = $eventName;
        return $this;
    }

    /** @return static */
    public function setLoggedAt(?Carbon $loggedAt = null): StoreLogRequestContract
    {
        $this->loggedAt =  $loggedAt ??  Carbon::now();
        return $this;
    }

    /** @return static */
    public function setImpersonatedBy(?string $impersonatedBy): StoreLogRequestContract
    {
        $this->impersonatedBy = $impersonatedBy;
        return $this;
    }

    /** @return static */
    public function setCrypKeys(array $cryptKeys): StoreLogRequestContract
    {
        $this->cryptKeys = $cryptKeys;
        return $this;
    }

    public function setUuid(?string $uuid): StoreLogRequestContract
    {
        $this->uuid = $uuid;
        return $this;
    }


    public function getUuid(): string
    {
        return $this->uuid ?? $this->uuid = Str::uuid();
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

    public function fromArray(array $attributes): self
    {
        $this->setResponsibleId($attributes["responsible_id"] ?? null);
        $this->setResponsibleType($attributes["responsible_type"] ?? null);
        $this->setAppKey($attributes["app_key"] ?? null);
        $this->setModelId($attributes["model_id"] ?? null);
        $this->setModelType($attributes["model_type"] ?? null);
        $this->setPayload(json_decode($attributes["payload"], true));
        $this->setLoggedAt($attributes["logged_at"] ?? null);
        $this->setAccountUuid($attributes["account_uuid"] ?? null);
        $this->setImpersonatedBy($attributes["impersonated_by"] ?? null);
        return $this;
    }
    protected function parseToCarbon(string $date): Carbon
    {
        return Carbon::parse($date);
    }

    public function toArray(): array
    {
        return [
            "uuid" => $this->getUuid(),
            "responsible_id" => $this->getResponsibleId(),
            "responsible_type" => $this->getResponsibleType(),
            "app_key" => $this->getAppKey(),
            "model_id" => $this->getModelId(),
            "model_type" => $this->getModelType(),
            "payload" => $this->getPayload(),
            "account_uuid" => $this->getAccountUuid(),
            "event_name" => $this->getEventName(),
            "logged_at" => $this->getLoggedAt(),
            "impersonated_by" => $this->getImpersonatedBy(),
        ];
    }
}

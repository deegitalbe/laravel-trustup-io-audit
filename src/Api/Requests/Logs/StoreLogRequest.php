<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs;

use Carbon\Carbon;
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

    protected ?string $eventName;

    protected Carbon $loggedAt;

    protected ?string $impersonatedBy;

    protected ?string $imporsonatedBy;

    protected array $cryptKeys;


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
    }


    public function getUuid(): ?string
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

    public function getEventName(): ?string
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
        $this->setResponsibleId($attributes["responsible_id"]);
        $this->setResponsibleType($attributes["responsible_type"]);
        $this->setAppKey($attributes["app_key"]);
        $this->setModelId($attributes["model_id"]);
        $this->setModelType($attributes["model_type"]);
        $this->setPayload(json_decode($attributes["payload"], true));
        $this->setAccountUuid($attributes["account_uuid"]);
        $this->setImpersonatedBy($attributes["impersonated_by"]);
        return $this;
    }
    protected function parseToCarbon(string $date): Carbon
    {
        return Carbon::parse($date);
    }

    public function toArray(): array
    {
        return [
            "responsible_id" => $this->responsibleId,
            "responsible_type" => $this->responsibleType,
            "app_key" => $this->appKey,
            "model_id" => $this->modelId,
            "model_type" => $this->modelType,
            "payload" => $this->payload,
            "account_uuid" => $this->accountUuid,
            "event_name" => $this->eventName,
            "logged_at" => $this->loggedAt,
            "impersonated_by" => $this->impersonatedBy,
        ];
    }
}

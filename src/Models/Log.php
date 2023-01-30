<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;

class Log  implements LogContract
{
    protected string $responsible_id;

    protected string $responsible_type;

    protected ?string $app_key;

    protected ?int $model_id;

    protected ?string $model_type;

    protected ?array  $payload;

    protected ?string $account_uuid;

    protected ?string $event_name;

    protected Carbon $logged_at;

    protected ?string $impersonated_by;

    protected $fillable = ["responsible_id", "responsible_type", "app_key", "model_id", "model_type", "payload", "account_uuid", "event_name", "logged_at", "impersonated_by"];


    public function setResponsibleId(string $responsibleId): LogContract
    {
        $this->responsible_id = $responsibleId;
        return $this;
    }

    public function setResponsibleType(string $responsibleType): LogContract
    {
        $this->responsible_type = $responsibleType;
        return $this;
    }

    public function setAppKey(?string $appKey): LogContract
    {
        $this->app_key = $appKey;
        return $this;
    }

    public function setModelId(?string $modelId): LogContract
    {
        $this->model_id = $modelId;
        return $this;
    }

    public function setModelType(?string $modelType): LogContract
    {
        $this->model_type = $modelType;
        return $this;
    }

    public function setPayload(?array $payload): LogContract
    {
        $this->payload = $payload;
        return $this;
    }

    public function setAccountUuid(?string $accountUuid): LogContract
    {
        $this->account_uuid = $accountUuid;
        return $this;
    }

    public function setEventName(?string $eventName): LogContract
    {
        $this->event_name = $eventName;
        return $this;
    }

    public function setLoggedAt(Carbon $loggedAt): LogContract
    {
        $this->logged_at = $loggedAt;
        return $this;
    }

    public function setImpersonatedBy(?string $impersonatedBy): LogContract
    {
        $this->impersonated_by = $impersonatedBy;
        return $this;
    }


    public function getResponsibleId(): string
    {
        return $this->responsible_id;
    }

    public function getResponsibleType(): string
    {
        return $this->responsible_type;
    }

    public function getAppKey(): ?string
    {
        return $this->app_key;
    }

    public function getModelId(): ?string
    {
        return $this->model_id;
    }

    public function getModelType(): ?string
    {
        return $this->model_type;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }

    public function getAccountUuid(): ?string
    {
        return $this->account_uuid;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function getLoggedAt(): Carbon
    {
        return $this->logged_at;
    }

    public function getImpersonatedBy(): ?string
    {
        return $this->impersonated_by;
    }

    public function fromArray(array $log): LogContract
    {
        $this->setResponsibleId($log["responsible_id"]);
        $this->setResponsibleType($log["responsible_type"]);
        $this->setAppKey($log["app_key"]);
        $this->setModelId($log["model_id"]);
        $this->setModelType($log["model_type"]);
        $this->setPayload(json_decode($log["payload"], true));
        $this->setAccountUuid($log["account_uuid"]);
        $this->setEventName($log["event_name"]);
        $this->setLoggedAt($this->parseToCarbon($log["logged_at"]));
        $this->setImpersonatedBy($log["impersonated_by"]);
        return $this;
    }

    protected function parseToCarbon(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}

<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

interface StoreLogRequestContract extends Arrayable
{
    /** @return static */
    public function setResponsibleId(?string $responsibleId): StoreLogRequestContract;

    /** @return static */
    public function setResponsibleType(?string $responsibleType): StoreLogRequestContract;

    /** @return static */
    public function setAppKey(?string $appKey): StoreLogRequestContract;

    /** @return static */
    public function setModelId(?string $modelId): StoreLogRequestContract;

    /** @return static */
    public function setModelType(?string $modelType): StoreLogRequestContract;

    /** @return static */
    public function setPayload(?array $payload): StoreLogRequestContract;

    /** @return static */
    public function setAccountUuid(?string $accountUuid): StoreLogRequestContract;

    /** @return static */
    public function setEventName(string $eventName): StoreLogRequestContract;

    /** @return static */
    public function setLoggedAt(?Carbon $loggedAt = null): StoreLogRequestContract;

    /** @return static */
    public function setImpersonatedBy(?string $impersonatedBy): StoreLogRequestContract;

    /** @return static */
    public function setCrypKeys(array $cryptKeys): StoreLogRequestContract;

    public function getResponsibleId(): ?string;

    public function getResponsibleType(): ?string;

    public function getAppKey(): ?string;

    public function getModelId(): ?string;

    public function getModelType(): ?string;

    public function getPayload(): ?array;

    public function getAccountUuid(): ?string;

    public function getEventName(): ?string;

    public function getLoggedAt(): Carbon;

    public function getImpersonatedBy(): ?string;
}
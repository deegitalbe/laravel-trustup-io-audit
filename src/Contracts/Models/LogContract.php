<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

use Carbon\Carbon;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\ExternalModelContract;

interface LogContract extends ExternalModelContract
{
    /** @return static */
    public function setResponsibleId(?string $responsibleId): LogContract;

    /** @return static */
    public function setResponsibleType(?string $responsibleType): LogContract;

    /** @return static */
    public function setAppKey(?string $appKey): LogContract;

    /** @return static */
    public function setModelId(?string $modelId): LogContract;

    /** @return static */
    public function setModelType(?string $modelType): LogContract;

    /** @return static */
    public function setPayload(?array $payload): LogContract;

    /** @return static */
    public function setAccountUuid(?string $accountUuid): LogContract;

    /** @return static */
    public function setEventName(string $eventName): LogContract;

    /** @return static */
    public function setLoggedAt(?Carbon $loggedAt = null): LogContract;

    /** @return static */
    public function setImpersonatedBy(?string $impersonatedBy): LogContract;

    /** @return static */
    public function setId(int $id): LogContract;

    /** @return static */
    public function setUuid(?string $uuid): LogContract;

    public function getUuid(): string;

    public function getResponsibleId(): ?string;

    public function getResponsibleType(): ?string;

    public function getAppKey(): ?string;

    public function getModelId(): ?string;

    public function getModelType(): ?string;

    public function getPayload(): ?array;

    public function getAccountUuid(): ?string;

    public function getEventName(): string;

    public function getLoggedAt(): Carbon;

    public function getImpersonatedBy(): ?string;

    public function getId(): int;
}

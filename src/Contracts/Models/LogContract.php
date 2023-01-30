<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Models;

use Carbon\Carbon;

interface LogContract
{

  public function setResponsibleId(string $responsibleId): LogContract;

  public function setResponsibleType(string $responsibleType): LogContract;

  public function setAppKey(?string $appKey): LogContract;

  public function setModelId(?string $modelId): LogContract;

  public function setModelType(?string $modelType): LogContract;

  public function setPayload(?array $payload): LogContract;

  public function setAccountUuid(?string $accountUuid): LogContract;

  public function setEventName(?string $eventName): LogContract;

  public function setLoggedAt(Carbon $loggedAt): LogContract;

  public function setImpersonatedBy(?string $impersonatedBy): LogContract;

  public function getResponsibleId(): string;

  public function getResponsibleType(): string;

  public function getAppKey(): ?string;

  public function getModelId(): ?string;

  public function getModelType(): ?string;

  public function getPayload(): ?array;

  public function getAccountUuid(): ?string;

  public function getEventName(): ?string;

  public function getLoggedAt(): Carbon;

  public function getImpersonatedBy(): ?string;

  public function fromArray(array $log): LogContract;
}

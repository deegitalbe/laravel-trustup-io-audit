<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
            "id" => $this->getId(),
            "uuid" => $this->getUuid(),
            "event_name" => $this->getEventName(),
            "responsible_id" => $this->getresponsibleId(),
            "responsible_type" => $this->getResponsibleType(),
            "app_key" => $this->getAppKey(),
            "model_id" => $this->getModelId(),
            "model_type" => $this->getModelType(),
            "payload" => $this->getPayload(),
            "logged_at" => $this->getLoggedAt(),
            "account_uuid" => $this->getAccountUuid(),
            "impersonated_by" => $this->getImpersonatedBy(),
        ];
    }
}

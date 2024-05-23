<?php

namespace App\Http\Resources\Reason;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReasonRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_reason' => $this->name_reason,
        ];
    }
}

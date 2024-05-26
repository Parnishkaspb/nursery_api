<?php

namespace App\Http\Resources\WorkMoney;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkMoneyRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_reason' => $this->reasons ? $this->reasons->name_reason : 'Не указано',
            'id_user' => $this->users ? $this->users->name : 'Не указано',
            'money' => $this->money,
            'numberdoc' => $this->numberdoc
        ];
    }
}

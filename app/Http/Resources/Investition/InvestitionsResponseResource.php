<?php

namespace App\Http\Resources\Investition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestitionsResponseResource extends JsonResource
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
            'user_name' => $this->ho_invest->name,
            'amount' => $this->summa,
        ];
    }
}

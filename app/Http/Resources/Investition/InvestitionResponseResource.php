<?php

namespace App\Http\Resources\Investition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestitionResponseResource extends JsonResource
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
            'id_user' => $this->id_user,
            'summa' => $this->summa,
            'money_give' => $this->money_give,
            'percent' => $this->percent,
            'years' => $this->years,
            'create' => $this->created_at,
            'update' => $this->updated_at,
        ];
    }
}

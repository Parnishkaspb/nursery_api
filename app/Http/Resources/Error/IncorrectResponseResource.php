<?php

namespace App\Http\Resources\Error;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncorrectResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => 401,
            'message' => $this->resource['message']
        ];
    }
}

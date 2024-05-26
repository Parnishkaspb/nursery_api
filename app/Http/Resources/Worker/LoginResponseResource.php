<?php

namespace App\Http\Resources\Worker;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'code' => 200,
            'access_token' => $this->resource['token'],
            'token_type' => 'Bearer',
            'role' => $this->resource['role'],
            'name' => $this->resource['name'],
        ];
    }
}

<?php

namespace App\Http\Resources\Users;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetListUser extends JsonResource
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
            'role_id' => $this->role_id,
            'role_name' => $this->role?->role ?? null,
            'name' => $this->name,
            'email' => $this->email,
            'raw_created_at' => $this->created_at,
            'parse_created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}

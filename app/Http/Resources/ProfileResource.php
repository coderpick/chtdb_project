<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'user_id' => $this->user_id,
            'phone' => $this->phone,
            'district' => $this->district,
            'upazila' => $this->upazila,
            'dob' => $this->dob?->format('Y-m-d'),
            'gender' => $this->gender,
            'nid' => $this->nid,
            'address' => $this->address,
            'bio' => $this->bio,
            'photo' => $this->photo ? url('storage/'.$this->photo) : null,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

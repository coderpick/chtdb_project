<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
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
            'status' => $this->status,
            'income' => $this->income,
            'company' => $this->company,
            'designation' => $this->designation,
            'join_date' => $this->join_date?->format('Y-m-d'),
            'location' => $this->location,
            'platform' => $this->platform,
            'profile_link' => $this->profile_link,
            'completed_projects' => $this->completed_projects,
            'rating' => $this->rating,
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'employees' => $this->employees,
            'business_website' => $this->business_website,
            'story' => $this->story,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

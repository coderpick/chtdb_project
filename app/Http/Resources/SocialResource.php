<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'linkedin' => $this->linkedin,
            'github' => $this->github,
            'website' => $this->website,
            'facebook' => $this->facebook,
        ];
    }
}

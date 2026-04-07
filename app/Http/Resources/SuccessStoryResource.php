<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SuccessStoryResource extends JsonResource
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
            'student_name' => $this->studentProfile->user->name ?? '',
            'student_photo' => $this->studentProfile->photo ? url(Storage::url($this->studentProfile->photo)) : null,
            'district' => $this->studentProfile->district ?? '',
            'training_center' => $this->trainingCenter ? [
                'id' => $this->trainingCenter->id,
                'name' => $this->trainingCenter->name,
                'district' => $this->trainingCenter->district,
            ] : null,
            'career' => $this->career ? [
                'id' => $this->career->id,
                'designation' => $this->career->designation,
                'income' => $this->career->income,
                'status' => $this->career->status,
                'business_name' => $this->career->business_name,
            ] : null,
            'story_text' => $this->story_text,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

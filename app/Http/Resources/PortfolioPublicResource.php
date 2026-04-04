<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioPublicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this;
        $profile = $this->profile;
        $training = $this->training;
        $career = $this->career;
        $skills = $this->skills ?? collect();
        $projects = $this->projects ?? collect();
        $socials = $this->socialLinks;
        $portfolio = $this->portfolioSetting;

        $name = $user->name;
        $initial = strtoupper(mb_substr($name, 0, 1));

        return [
            'name' => $name,
            'photo' => $profile?->photo ? url('storage/'.$profile->photo) : null,
            'photo_initial' => ! $profile?->photo ? $initial : null,
            'tagline' => $portfolio?->tagline ?? $career?->status ?? $training?->course?->name ?? 'আইসিটি প্রশিক্ষণার্থী',
            'location' => $profile
                ? collect([$profile->upazila, $profile->district])->filter()->join(', ')
                : 'পার্বতিক চট্টগ্রাম',
            'bio' => $profile?->bio,
            'training' => [
                'course' => $training?->course?->name ?? null,
                'batch' => $training?->batch?->name ?? null,
                'center' => $training?->center?->name ?? null,
                'status' => $training?->status,
                'start_date' => $training?->start_date?->format('Y-m-d'),
                'end_date' => $training?->end_date?->format('Y-m-d'),
                'certificate_no' => $training?->certificate_no,
                'grade' => $training?->grade,
            ],
            'career' => [
                'status' => $career?->status,
                'income' => $career?->income,
                'company' => $career?->company,
                'designation' => $career?->designation,
                'platform' => $career?->platform,
                'profile_link' => $career?->profile_link,
            ],
            'projects' => ProjectResource::collection($projects)->resolve(),
            'skills' => $skills->pluck('name'),
            'social' => [
                'linkedin' => $socials?->linkedin,
                'github' => $socials?->github,
                'website' => $socials?->website,
                'facebook' => $socials?->facebook,
            ],
            'portfolio_settings' => [
                'theme' => $portfolio?->theme,
                'is_visible' => (bool) $portfolio?->is_visible,
            ],
        ];
    }
}

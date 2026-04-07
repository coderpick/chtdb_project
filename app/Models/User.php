<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function training()
    {
        return $this->hasOne(Training::class);
    }

    public function career()
    {
        return $this->hasOne(Career::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class)->withTimestamps();
    }

    public function socialLinks()
    {
        return $this->hasOne(SocialLink::class);
    }

    public function portfolioSetting()
    {
        return $this->hasOne(PortfolioSetting::class);
    }

    public function successStories()
    {
        return $this->hasManyThrough(SuccessStory::class, StudentProfile::class);
    }
}

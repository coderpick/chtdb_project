<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'duration_weeks',
        'is_active',
        'order',
    ];

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'district_id',
        'upazila_id',
        'dob',
        'gender',
        'nid',
        'address',
        'bio',
        'photo',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'user_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'income',
        'company',
        'designation',
        'join_date',
        'location',
        'platform',
        'profile_link',
        'completed_projects',
        'rating',
        'business_name',
        'business_type',
        'employees',
        'business_website',
        'story',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

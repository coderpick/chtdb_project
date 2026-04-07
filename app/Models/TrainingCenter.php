<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district_id',
        'address',
        'phone',
        'email',
        'is_active',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

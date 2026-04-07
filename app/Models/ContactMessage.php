<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'district_id',
        'course',
        'message',
        'status',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

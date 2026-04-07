<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_center_id',
        'course_id',
        'shift',
        'name',
        'start_date',
        'end_date',
        'capacity',
        'enrolled_count',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function center()
    {
        return $this->belongsTo(TrainingCenter::class, 'training_center_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}

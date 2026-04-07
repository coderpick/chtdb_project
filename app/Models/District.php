<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'bn_name'];

    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }

    public function trainingCenters()
    {
        return $this->hasMany(TrainingCenter::class);
    }

    public function studentProfiles()
    {
        return $this->hasMany(StudentProfile::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    protected $fillable = [
        'district_id', 'upazila_id', 'batch_id', 'name', 'father_name', 'mother_name', 'phone', 'email', 'academic_qualification', 'address', 'freelancer_profile_url', 'profile_photo', 'income_source', 'gender',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function getPhoneAttribute($value)
    {
        return preg_replace('/\s+/', '', $value); // remove all spaces
    }

    public function getFreelancerProfileUrlAttribute($value)
    {
        return $value ? $value : null;
    }

    public function getProfilePhotoAttribute($value)
    {
        return $value ? $value : null;
    }

    // Custom getter methods for clean display
    public function getName()
    {
        return ucfirst($this->name);
    }

    public function getFatherName()
    {
        return ucfirst($this->father_name);
    }

    public function getMotherName()
    {
        return ucfirst($this->mother_name);
    }

    public function getAcademicQualification()
    {
        return ucfirst($this->academic_qualification);
    }

    public function getAddress()
    {
        return ucfirst($this->address);
    }

    public function getIncomeSource()
    {
        return ucfirst($this->income_source);
    }

    public function getFreelancerUrl()
    {
        $url = $this->freelancer_profile_url;

        if (empty($url)) {
            return null;
        }

        // Add https if missing
        if (! preg_match('/https?:\/\//i', $url)) {
            $url = 'https://'.$url;
        }

        return $url;
    }

    public function getProfilePhotoUrl()
    {
        if (empty($this->profile_photo)) {
            return null;
        }

        return asset($this->profile_photo);
    }
}

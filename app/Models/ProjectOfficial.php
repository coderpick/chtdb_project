<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectOfficial extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'organization',
        'image',
        'facebook_url',
        'linkedin_url',
        'email',
        'order',
        'status',
    ];}

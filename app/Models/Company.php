<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobOffer;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
        'location'
    ];

    // relation one to one with user model 
    public function user() {
        return $this->belongsTo(User::class);
    }

    // relation one to many with jobOffer model 
    public function jobOffers() {
        return $this->hasMany(JobOffer::class);
    }
}

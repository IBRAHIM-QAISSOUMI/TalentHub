<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobOffer;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_offer_id',
        'status',
        'cover_letter'
    ];

    
    // relation one to many with user model 
    public function user() {
        return $this->belongsTo(User::class);
    }


    // relation one to many with jobOffer model 
    public function jobOffer() {
        return $this->belongsTo(JobOffer::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;

class CandidateProfile extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'bio'
    ];


    // relation one to one with user model
    public function user() {
        return $this->belongsTo(User::class);
    }


    // relation one to many with education model
    public function educations() {
        return $this->hasMany(Education::class);
    }


    // relation one to many with experience model
    public function experiences() {
        return $this->hasMany(Experience::class);
    }


    // relation many to many with skill model 
    public function skills () {
        return $this->belongsToMany(Skill::class);
    }
}

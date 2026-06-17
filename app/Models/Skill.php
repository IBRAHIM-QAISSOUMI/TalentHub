<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CandidateProfile;

class Skill extends Model
{
    protected $fillable = [
        'name'
    ];


    // relation many to many with candidateProfile model 
    public function candidateProfiles () {
        return $this->belongsToMany(CandidateProfile::class);
    }
}

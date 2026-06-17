<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CandidateProfile;

class Experience extends Model
{
        protected $fillable = [
        'candidate_profile_id',
        'position',
        'company',
        'start_date',
        'end_date'
    ];


    // relation one to many with candidateProfile model
    public function candidateProfile() {
        return $this->belongsTo(CandidateProfile::class);
    }

}

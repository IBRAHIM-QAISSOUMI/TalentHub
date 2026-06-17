<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CandidateProfile;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'candidate_profile_id',
        'degree',
        'school',
        'start_year',
        'end_year'
    ];


    // relation one to many with candidateProfile model
    public function candidateProfile() {
        return $this->belongsTo(CandidateProfile::class);
    }
}

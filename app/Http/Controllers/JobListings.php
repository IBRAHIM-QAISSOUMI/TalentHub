<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;

class JobListings extends Controller
{
    public function index() {
        
        $jobsTotal = JobOffer::where('is_closed', 0)->count();

        return view('job.candidate.index', compact('jobsTotal'));
    }
}

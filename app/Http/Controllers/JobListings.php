<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;

class JobListings extends Controller
{
    public function index() {
        
        $jobs = JobOffer::where('is_closed', 0)->latest()->get();

        return view('job.candidate.index', compact('jobs'));
    }
}

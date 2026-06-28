<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\Application;

class ApplicationController extends Controller
{

    public function index () {
        
        if(auth()->user()->hasRole('candidate')) {

             $applications = auth()->user()->applications()->latest()->get();
             return view('applications.index', compact('applications'));

        } else {
            
            $jobs = auth()->user()->company->jobOffers()->with('applications.user')->get() ;
            
            $totalApplications = $jobs->sum(function ($job) {
                return $job->applications->count();
            });

            $accepted = $jobs->sum(function ($job) {
                return $job->applications->where('status', 'accepted')->count();
            });

            $pending = $jobs->sum(function ($job) {
                return $job->applications->where('status', 'pending')->count();
            });

            return view('applications.index', compact('jobs', 'totalApplications', 'pending', 'accepted'));
        } 

    }

    public function create(Request $request) {

        $id = $request->id;
        $job = JobOffer::findOrfail($id);
        return view('applications.create', compact('job'));
    }

    public function store(Request $request) {

        $user_id = auth()->user()->id;
        $jobOffer_id = $request->id;

        $request->validate([
            'cover_letter' => 'nullable|string|min:15|max:1000',
        ]);
        
        $found = Application::where('user_id', $user_id)->where('job_offer_id',  $jobOffer_id)->exists();

        if ($found) {
            return back()->with('error', 'You have already applied for this job.');
        }


        Application::create([
            'user_id' => $user_id,
            'job_offer_id' => $jobOffer_id,
            'cover_letter' => $request->cover_letter
        ]);
        

        return redirect()->route('applications.index')->with('success', 'Application submitted successfully.');

    }


    public function destroy(string $id) {

        Application::destroy($id);

        return redirect()->route('applications.index')->with('success', 'Application canceled successfully');
    }


    public function job_applications(string $id) {
        
        $job = JobOffer::with('applications.user')->findOrFail($id);

        return view('applications.job-applications', compact('job'));
    }


    public function accept(Application $application) {

        $application->update(['status' => 'accepted']);

        return back()->with('success', 'Application accepted successfully.');
    }

    public function reject(Application $application) {

        $application->update(['status' => 'rejected']);

        return back()->with('success', 'Application rejected successfully.');
    }
    
}


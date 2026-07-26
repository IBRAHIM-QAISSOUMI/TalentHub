<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\Application;
use App\Models\User;
use App\Notifications\JobApplicationsNotification;
use App\Notifications\ApplicationAcceptedNotification;
use App\Notifications\ApplicationRejectedNotification;

class ApplicationController extends Controller
{

    public function index () {
        
        if(auth()->user()->hasRole('candidate')) {

             $totalApp = auth()->user()->applications()->count();
             $totalAppAccepted = auth()->user()->applications()->where('status', 'accepted')->count();
             $totalAppPending = auth()->user()->applications()->where('status', 'pending')->count();
             
             return view('applications.index', compact('totalApp','totalAppPending', 'totalAppAccepted'));

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

        $user = auth()->user();

        $jobOffer_id = $request->id;

        $jobOffer = JobOffer::findOrfail($jobOffer_id);

        $recruiter = $jobOffer->company->user;

        $request->validate([
            'cover_letter' => 'nullable|string|min:15|max:1000',
        ]);
        
        $found = Application::where('user_id', $user->id)->where('job_offer_id',  $jobOffer_id)->exists();

        if ($found) {
            return back()->with('error', 'You have already applied for this job.');
        }


        Application::create([
            'user_id' => $user->id,
            'job_offer_id' => $jobOffer_id,
            'cover_letter' => $request->cover_letter
        ]);

        $recruiter->notify(new JobApplicationsNotification($user, $jobOffer));
        

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

        $jobOffer = $application->jobOffer;

        $user = User::findOrFail($application->user_id);

        $user->notify(new ApplicationAcceptedNotification($jobOffer));

        return back()->with('success', 'Application accepted successfully.');
    }

    public function reject(Application $application) {

        $application->update(['status' => 'rejected']);

        $jobOffer = $application->jobOffer;

        $user = User::findOrFail($application->user_id);

        $user->notify(new ApplicationRejectedNotification($jobOffer));

        return back()->with('success', 'Application rejected successfully.');
    }
    
}


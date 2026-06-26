<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\Application;

class ApplicationController extends Controller
{

    public function index () {
        $applications = auth()->user()->applications()->latest()->get();
        return view('applications.index', compact('applications'));
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
}

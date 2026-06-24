<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = auth()->user()->company->jobOffers()->with('applications')->get();
        return view('job.company.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|min:5|max:100',

            'location' => 'required|string|max:100',

            'contract_type' => 'required|string|in:full-time,part-time,internship',

            'work_mode' => 'required|string|in:remote,on-site,hybrid',

            'description' => 'required|string|min:15|max:2000',

            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // uploade a image
        $imagePath = null;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        

        JobOffer::create([
            'company_id' => auth()->user()->company->id,
            'title' => $request->title,
            'location' => $request->location,
            'contract_type' => $request->contract_type,
            'work_mode' => $request->work_mode,
            'description' => $request->description,
            'image' => $imagePath,

        ]);

        return redirect()->route('jobs.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = JobOffer::findOrFail($id);
        return view('job.company.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = JobOffer::findOrFail($id);

        $request->validate([

            'title' => 'required|string|min:5|max:100',

            'location' => 'required|string|max:100',

            'contract_type' => 'required|string|in:full-time,part-time,internship',

            'work_mode' => 'required|string|in:remote,on-site,hybrid',

            'description' => 'required|string|min:15|max:2000',

            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        // upload image
        $imagePath = $job->image;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }


        // update job 
        $job->update([
            'title' => $request->title,
            'location' => $request->location,
            'contract_type' => $request->contract_type,
            'work_mode' => $request->work_mode,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

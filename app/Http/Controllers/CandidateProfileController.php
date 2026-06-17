<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Models\Skill;

class CandidateProfileController extends Controller
{
    public function edit() {
        $skills = Skill::all();
        return view('profile.candidate.edit', compact('skills'));
    }


    public function update(Request $request) {
        $request->validate([

            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',

            'name' => 'required|string|min:3|max:50',

            'title' => 'required|string|min:3|max:100',

            'country' => 'required|string|max:100',

            'city' => 'required|string|max:100',

            'bio' => 'required|string|min:20|max:500',


            // many to many
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',


            // one to many education
            'education' => 'nullable|array',

            'education.school' => 'required|string|max:150',
            'education.degree' => 'required|string|max:150',
            'education.start_date' => 'nullable|date',
            'education.end_date' => 'nullable|date|after_or_equal:education.start_date',


            // one to many experience
            'experience' => 'nullable|array',

            'experience.company' => 'required|string|max:150',
            'experience.position' => 'required|string|max:150',
            'experience.start_date' => 'nullable|date',
            'experience.end_date' => 'nullable|date|after_or_equal:experience.start_date',


            // CV
            'cv' => 'nullable|file|mimes:pdf|max:5120',

        ]); 


        // upload avatar 
        $avatarPath = null;

        if($request->hasFile('avatar') ) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }


        // upload cv 
        $cvPath = null; 

        if($request->hasFile('cv') ) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // update candidateProfile 
        $profile = auth()->user()->candidateProfile;

        $profile->update([
            'avatar' => $avatarPath,
            'name' => $request->name,
            'title' => $request->title,
            'country' => $request->country,
            'city' => $request->city,
            'bio' => $request->bio,
            'cv' => $cvPath,
            'is_completed' => true
        ]);

        // attach skills
        $profile->skills()->sync($request->skills);

        
        // create experience
        if ($request->filled('experience')) {
            
            $profile->experiences()->create(
                $request->experience
                );
                
                }
                
        // create education
        if ($request->filled('education')) {
        
            $profile->educations()->create(
                $request->education
            );
        
        }

        return redirect()
        ->route('candidate.show')
        ->with('success','Profile completed');

    }


    public function show() {
        return 'success, Profile completed';
    }
}

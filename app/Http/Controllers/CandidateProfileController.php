<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Models\Skill;
use App\Models\User;

class CandidateProfileController extends Controller
{
    public function edit() {
        $skills = Skill::all();
        $candidateProfile = auth()->user()->candidateProfile;

        return view('profile.candidate.edit', compact('skills', 'candidateProfile'));
    }



    // ====================================================
    public function update(Request $request) {
        $request->validate([

            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',

            'name' => 'nullable|string|min:3|max:50',

            'title' => 'nullable|string|min:3|max:100',

            'country' => 'nullable|string|max:100',

            'city' => 'nullable|string|max:100',

            'bio' => 'nullable|string|min:20|max:500',


            // many to many
            'skills' => 'nullable|array|min:1',
            'skills.*' => 'exists:skills,id',


            // one to many education
            'education' => 'nullable|array',

            'education.school' => 'nullable|string|max:150',
            'education.degree' => 'nullable|string|max:150',
            'education.start_date' => 'nullable|date',
            'education.end_date' => 'nullable|date|after_or_equal:education.start_date',


            // one to many experience
            'experience' => 'nullable|array',

            'experience.company' => 'nullable|string|max:150',
            'experience.position' => 'nullable|string|max:150',
            'experience.start_date' => 'nullable|date',
            'experience.end_date' => 'nullable|date|after_or_equal:experience.start_date',


            // CV
            'cv' => 'nullable|file|mimes:pdf|max:5120',

        ]); 


        $profile = auth()->user()->candidateProfile;


        // upload avatar 
        $avatarPath = null;

        if($request->hasFile('avatar') ) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $avatarPath;
        }


        // upload cv 
        $cvPath = null; 

        if($request->hasFile('cv') ) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $profile->cv = $cvPath;
        }


        $profile->save();
        
        // update candidateProfile 

        $profile->update([
            'name' => $request->name,
            'title' => $request->title,
            'country' => $request->country,
            'city' => $request->city,
            'bio' => $request->bio,
            'is_completed' => true
        ]);

        // attach skills
        $profile->skills()->sync($request->skills);

        
        // create experience
        if (!empty($request->experience['company'])) {

            $profile->experiences()->create(
                $request->experience
            );

        }

                
        // create education
        if (!empty($request->education['school'])) {

            $profile->educations()->create(
                $request->education
            );

        }

        return redirect()
        ->route('candidate.show')
        ->with('success','Profile completed');

    }



    // ==========================================================================
    public function show(Request $request) {

        $id = $request->id;

        if ($id) {
            $profile = User::findOrfail($id)->candidateProfile()
            ->with(['skills', 'experiences', 'educations'])
            ->firstOrFail();

        } else {
            $profile = auth()->user()->candidateProfile()
            ->with(['skills', 'experiences', 'educations'])
            ->firstOrFail();
        }

        $users = User::with('candidateProfile')->take(10)->get();

        return view('profile.candidate.show', compact('profile', 'users'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyProfileController extends Controller
{
    public function edit() {
        $company = auth()->user()->company;
        return view('profile.company.edit', compact('company'));
    }



    // ==============================================================
    public function update(Request $request) {

        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',

            'name' => 'required|string|min:3|max:100',

            'industry' => 'required|string|max:100',

            'size' => 'required|string|max:100',

            'website' => 'nullable|url|max:255',

            'country' => 'required|string|max:100',

            'city' => 'required|string|max:100',

            'description' => 'required|string|min:20|max:500',
        ]);


        $company = auth()->user()->company;
        
        // uplaod vatare company 
        $logoPath = null;

        if($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $company->logo = $logoPath;

            $company->save();
        }


        // save data 
        $company->update([
            'name' => $request->name,
            'industry' => $request->industry,
            'size' => $request->size,
            'website' => $request->website,
            'country' => $request->country,
            'city' => $request->city,
            'description' => $request->description,
        ]);


        return redirect()->route('company.show');

    }



    // ===========================================================

<<<<<<< HEAD
    public function show(Request $request) {

        $id = $request->id;
        $company = auth()->user()->company()->with('jobOffers')->firstOrfail();

        return view('profile.company.show', compact('company'));
=======
    public function show() {

        
>>>>>>> cd4f6271a7a449568d2870a5904436eedf3a024a
    }
}

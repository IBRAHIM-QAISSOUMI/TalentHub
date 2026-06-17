<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\Company;



class AuthController extends Controller
{
    // show form register 
    public function showFormRegister(){
        return view("auth.register");
    }



    // register function 
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|min:8|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|max:50',
            'role' => 'required|in:candidate,recruiter',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($request->role == 'candidate') {
            $user->assignRole($request->role);

            Auth::login($user);

            CandidateProfile::create([
                'user_id' => $user->id
            ]);

            return redirect()->route('candidate.edit');
        }

        if($request->role == 'recruiter') {
            $user->assignRole($request->role);

            Auth::login($user);
            
            Company::create([
                'user_id' => $user->id
            ]);

            return redirect()->route('recruiter.edit');
        }

    }


    // show form login 
    public function showFormLogin(){
        return view('auth.login');
    }


    // login function 
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // remember me
        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember))
        {
            $request->session()->regenerate();

            if(Auth::user()->hasRole('candidate'))
                {
                    if (Auth::user()->hasRole('candidate')) {

                    if (!Auth::user()->candidateProfile->is_completed) {

                        return redirect('/candidate/profile/edit');
                    }
                    return redirect('/candidate/dashboard');
                }
                };

            if(Auth::user()->hasRole('recruiter'))
                {
                    if(!Auth::user()->Company->is_completed) {
                        return redirect('/company/profile/edit');
                    }
                    
                    return redirect('recruiter/dashboard');
                }
            if(Auth::user()->hasRole('admin'))
                {
                    return redirect('admin/dashboard');
                };
        }

        return back()->withErrors([
        'email' => 'email or password is incorrect'
    ]);
    }


    // logout function 
    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

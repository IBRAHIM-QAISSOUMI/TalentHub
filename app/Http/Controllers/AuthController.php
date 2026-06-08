<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



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

        $user->assignRole($request->role);

        Auth::login($user);

        return redirect()->route('home');
        // if($request->role == 'candidate') {
        //     $user->assignRole($request->role);
        //     CandidateProfile::create([
        //         'user_id' => $user->id
        //     ]);
        // }

        // if($request->role == 'recruiter') {
        //     $user->assignRole($request->role);
        //     CompanyProfile::create([
        //         'user_id' => $user->id
        //     ]);
        // }
        
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
            return redirect()->route('home');
        }

        return back()->withErrors([
        'email' => 'email or password is incorrect'
    ]);
    }


    // logout function 
    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

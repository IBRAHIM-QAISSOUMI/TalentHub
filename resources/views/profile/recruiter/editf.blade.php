@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    
    <div class="h-screen max-w-3xl mx-auto py-8">

        <!-- main -->
        <h2 class="text-gray-900  font-semibold text-xl">Edit company profile</h2>
        <p class="text-sm text-gray-600 mb-3">This information will be visible to candidates and other recruiters.</p>

         <!-- logo -->
         <div class="w-full h-full px-6 py-5 bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden ">
            <h3 class="text-base font-semibold capitalize text-gray-800">Logo</h3>
            <div>
                <span></span>
                <input type="file" name="" id="">
            </div>
         </div>
         <!-- end logo -->

        <!-- end main -->

    </div>




@endsection
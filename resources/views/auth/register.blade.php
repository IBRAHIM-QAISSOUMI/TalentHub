<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-neutral-100 flex items-center justify-center px-10 py-8 font-sans">

        <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">

        <!-- LEFT SIDE (FORM) -->
        <div class="w-full md:w-1/2 p-6 md:p-10">
            <!-- LOGO -->
            <div class="flex items-center gap-2 mb-6">
                <img src="{{ asset('assets/TalentHub-logo.jpeg') }}" class="w-14 h-auto">
                <p class="text-2xl font-bold text-gray-800">TalentHub</p>
            </div>

            <form method="post" action="{{route('register')}}" class="space-y-4">
                @csrf

                <p class="text-sm text-gray-500">Please enter your details</p>
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Create a New Account
                </h2>

                <!-- Name -->
                <input type="text" placeholder="Name" name="name"  value="{{ old('name') }}"
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent focus:ring-2 focus:ring-blue-400"> 
                @error('name')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
                <!-- Email -->
                <input type="email" placeholder="Email" name="email"  value="{{ old('email') }}"  
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent focus:ring-2 focus:ring-blue-400">
                @error('email')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
                <!-- Password -->
                <input type="password" placeholder="Password" name="password"  
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent focus:ring-2 focus:ring-blue-400">
                @error('password')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
                <!-- Confirm Password -->
                <input type="password" placeholder="Confirm Password" name="password_confirmation"  
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent focus:ring-2 focus:ring-blue-400">
                <!-- ROLE -->
                <div class="grid grid-cols-2 gap-3 mt-4">

                    <!-- Candidate -->
                    <label>
                        <input type="radio" name="role" value="candidate" class="peer hidden" >

                        <div class="p-4 border border-gray-300 rounded-xl cursor-pointer transition
                            peer-checked:border-blue-500 peer-checked:bg-blue-50">

                            <p class="font-semibold text-gray-700 text-sm">
                                Candidate
                            </p>

                            <p class="text-xs text-gray-400">
                                Looking for a job
                            </p>
                        </div>
                    </label>

                    <!-- Recruiter -->
                    <label>
                        <input type="radio" name="role" value="recruiter" class="peer hidden">

                        <div class="p-4 border border-gray-300 rounded-xl cursor-pointer transition
                            peer-checked:border-blue-500 peer-checked:bg-blue-50">

                            <p class="font-semibold text-gray-700 text-sm">
                                Recruiter
                            </p>

                            <p class="text-xs text-gray-400">
                                Hiring candidates
                            </p>
                        </div>
                    </label>

                </div>
                @error('role')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full mt-6 bg-blue-500 hover:bg-blue-600 text-white font-medium p-3 rounded-lg transition">
                    Create Account
                </button>
                <!-- Divider -->
                <div class="flex items-center my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <p class="px-3 text-sm text-gray-400">or</p>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Google Button -->
                <button type="button"
                    class="w-full flex items-center justify-center gap-3 border border-gray-300
                    rounded-lg p-3 hover:bg-gray-50 transition">

                    <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                         class="w-5 h-5">

                    <span class="text-gray-700 font-medium">
                        Sign in with Google
                    </span>
                </button>

                <!-- Already have account -->
                <p class="text-center text-sm text-gray-500 mt-6">
                    Already have an account?
                    <a href="/login"
                       class="text-blue-500 font-medium hover:underline">
                        Sign in
                    </a>
                </p>

            </form>
        </div>

        <!-- RIGHT SIDE (IMAGE) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-blue-50 to-neutral-100 items-center justify-center">
            <img src="{{ asset('assets/sing-in.png') }}" class="w-64 md:w-96">
        </div>

    </div>

</body>
</html>






































<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen bg-neutral-400 flex items-center justify-center px-20 py-10">

    <div class="main-form w-full h-full bg-white  rounded-sm shadow-md">
        <div class="logo flex items-center gap-1 ms-10 mt-4">
            <span class="img">
                <img src="{{ asset('assets/TalentHub-logo.jpeg') }}" alt="logo" class="w-16 h-auto">
            </span>
            <p class="text-3xl font-bold">TalentHub</p>
        </div>
        <div class="center-from w-fit p-10 mt-5 m-auto">
            <form method="post">
                @csrf 
                <p class="text-gray-400">please enter your details</p>
                <p class="text-3xl mt-2 mb-8">Create a New account</p>
                    <input
                        type="text"
                        placeholder="Name"
                        required
                        class="w-full p-3 rounded-lg border border-gray-300 placeholder:text-gray-400/60 focus:outline-none focus:ring-2 focus:ring-blue-300 my-2"
                    >
                    <input
                        type="email"
                        placeholder="Enter your email"
                        class="w-full p-3 rounded-lg border border-gray-300 placeholder:text-gray-400/60  focus:outline-none focus:ring-2 focus:ring-blue-300 my-2"
                    />
                    <input
                        type="password"
                        placeholder="Enter your password"
                        class="w-full p-3 rounded-lg border border-gray-300 placeholder:text-gray-400/60  focus:outline-none focus:ring-2 focus:ring-blue-300 my-2"
                    />
                    <input
                        type="password"
                        placeholder="Confirme your password"
                        class="w-full p-3 rounded-lg border border-gray-300 placeholder:text-gray-400/60  focus:outline-none focus:ring-2 focus:ring-blue-300 my-2"
                    />
 <div class="grid grid-cols-2 gap-4 mt-4">

    <label>
        <input type="radio" name="role" value="candidate" class="peer hidden">

        <div class="p-4 border border-gray-300 rounded-xl cursor-pointer transition
                    peer-checked:border-red-600
                    peer-checked:bg-red-50">
            <h3 class="font-semibold">Candidate</h3>
            <p class="text-sm text-gray-500">
                Looking for a job
            </p>
        </div>
    </label>

    <label>
        <input type="radio" name="role" value="recruiter" class="peer hidden">

        <div class="p-4 border border-gray-300 rounded-xl cursor-pointer transition
                    peer-checked:border-red-600
                    peer-checked:bg-red-50">
            <h3 class="font-semibold">Recruiter</h3>
            <p class="text-sm text-gray-500">
                Hiring candidates
            </p>
        </div>
    </label>

</div>
            </form>
            <div class="image-sing-in">
            </div>
        </div>
        

    </div>

</body>
</html> -->
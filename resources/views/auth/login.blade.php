<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentHub Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-neutral-100 flex items-center justify-center px-10 py-8 font-sans">

    <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">
        

        <!-- LEFT SIDE (IMAGE) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-blue-50 to-neutral-100 items-center justify-center">

            <img src="{{ asset('assets/login.png') }}"
                 class="w-64 md:w-96">

        </div>
        <!-- RIGHT SIDE (FORM) -->
        <div class="w-full md:w-1/2 p-6 md:p-10">

            <!-- LOGO -->
            <div class="flex items-center gap-2 mb-6">
                <img src="{{ asset('assets/TalentHub-logo.jpeg') }}" class="w-14 h-auto">
                <p class="text-2xl font-bold text-gray-800">TalentHub</p>
            </div>

            <form method="POST" action="{{route('login')}}" class="space-y-4">
                @csrf

                <p class="text-sm text-gray-500">
                    Welcome back
                </p>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Sign In to Your Account
                </h2>

                <!-- Email -->
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent
                    focus:ring-2 focus:ring-blue-400">

                @error('email')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror

                <!-- Password -->
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full p-3 rounded-lg border border-gray-300
                    placeholder:text-gray-400/60
                    focus:outline-none focus:border-transparent
                    focus:ring-2 focus:ring-blue-400">

                @error('password')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-blue-500">

                        Remember Me
                    </label>

                    <a href="#"
                       class="text-sm text-blue-500 hover:underline">
                        Forgot Password?
                    </a>

                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full mt-4 bg-blue-500 hover:bg-blue-600
                    text-white font-medium p-3 rounded-lg transition">

                    Sign In

                </button>

                <!-- Divider -->
                <div class="flex items-center my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <p class="px-3 text-sm text-gray-400">or</p>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Google Button -->
                <button
                    type="button"
                    class="w-full flex items-center justify-center gap-3
                    border border-gray-300 rounded-lg p-3
                    hover:bg-gray-50 transition">

                    <img
                        src="https://www.svgrepo.com/show/475656/google-color.svg"
                        class="w-5 h-5">

                    <span class="text-gray-700 font-medium">
                        Sign in with Google
                    </span>

                </button>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-500 mt-6">

                    Don't have an account?

                    <a href="/"
                       class="text-blue-500 font-medium hover:underline">

                        Create Account

                    </a>

                </p>

            </form>

        </div>


    </div>

</body>
</html>
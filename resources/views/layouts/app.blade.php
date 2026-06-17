<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/TalentHub-logo-removebg.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <x-navbar />

    <main class="flex-1 max-w-7xl mx-auto w-full p-6">
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
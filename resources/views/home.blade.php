<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <p>Hello {{ Auth::user()?->name }}</p>

        <form method="post" action="{{route('logout')}}">
            @csrf
            <button type="submit">logout</button>
        </form>
    
    
</body>
</html>
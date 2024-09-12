<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Task Manager</h1>
        </div>
    </nav>
    

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
        
    </main>

    <footer class="bg-gray-200 mt-8 py-4">
        <div class="container mx-auto text-center text-gray-600">
            &copy; 2023 Task Manager
        </div>
    </footer>
    <div id="app">
        <!-- This is where your Vue app will be mounted -->
    </div>
</body>
</html>

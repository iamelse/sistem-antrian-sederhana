<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? env('APP_NAME', 'Dashboard') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

<!-- Navbar -->
<header class="bg-white shadow-sm fixed top-0 inset-x-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Left: Logo + Navigation -->
        <div class="flex items-center space-x-6">
            <a href="#" class="flex items-center space-x-2">
                <img src="https://flowbite.com/docs/images/logo.svg" alt="Logo" class="h-6">
                <span class="text-lg font-semibold">Iamelse</span>
            </a>
            <!-- Tabs -->
            <nav class="hidden md:flex space-x-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="px-3 py-2 text-sm font-medium rounded-md transition
                    {{ request()->routeIs('admin.dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-200' }}">
                    Dashboard
                </a>

                <a href="{{ route('queue.index') }}"
                   class="px-3 py-2 text-sm font-medium rounded-md transition
                    {{ request()->routeIs('queue.index') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-200' }}">
                    Antrian
                </a>
            </nav>
        </div>

        <!-- Right: Username & Logout Button -->
        <div class="flex items-center space-x-4">
            <!-- Display Username -->
            <span class="text-sm text-gray-700 font-medium">
                {{ Auth::user()->name }}
            </span>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

@yield('content')

</body>
</html>

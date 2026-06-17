<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-900">
                        Laravel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-lg font-semibold text-gray-900">
                        Laravel
                    </a>
                @endauth
            </div>

            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-gray-900">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="text-sm text-gray-700 hover:text-gray-900">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">
                        Log In
                    </a>

                    <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900">
                        Register
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>

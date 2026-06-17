<header class="w-full bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('homepage') }}" class="text-xl font-bold text-gray-900">
            {{ config('app.name', 'Laravel') }}
        </a>

        <nav class="flex items-center gap-4">
            <a href="{{ route('homepage') }}" class="text-sm text-gray-700 hover:text-gray-900">
                Home
            </a>

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
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-black !text-white text-sm font-semibold rounded-md hover:bg-gray-800">
                    Register
                </a>
            @endauth
        </nav>
    </div>
</header>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper'}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 text-2xl font-bold text-purple-600 hover:text-purple-700 transition-colors">
                    <span class="text-3xl">🐦</span>
                    <span>Chirper</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-6">
                    @auth
                        <a href="/" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">
                            Home
                        </a>
                        <a href="{{ route('profile.show', auth()->user()) }}" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">
                            Profile
                        </a>
                        
                        <!-- User Dropdown -->
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600">{{ auth()->user()->display_name }}</span>
                            <img src="{{ auth()->user()->avatar_url }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-10 h-10 rounded-full border-2 border-purple-600">
                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="/login" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors font-medium">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg">
                            Sign Up
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                @auth
                    <a href="/" class="block py-2 text-gray-700 hover:text-purple-600">Home</a>
                    <a href="{{ route('profile.show', auth()->user()) }}" class="block py-2 text-gray-700 hover:text-purple-600">Profile</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="block py-2 text-gray-700 hover:text-purple-600 w-full text-left">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="block py-2 text-gray-700 hover:text-purple-600">Sign In</a>
                    <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-purple-600">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Success Toast -->
    @if (session('success'))
        <div class="fixed top-20 right-4 z-50 animate-slide-up">
            <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-fade-out">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
       {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">© 2025 Chirper - Built with Laravel and ❤️</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
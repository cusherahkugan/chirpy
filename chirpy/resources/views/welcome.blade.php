<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirper - Micro-Blogging Platform</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .bird-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        
        .feature-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="max-w-6xl w-full">
        <!-- Header -->
        <div class="text-center mb-12 fade-in-up">
            <div class="text-8xl mb-6 bird-float">🐦</div>
            <h1 class="text-6xl font-bold text-white mb-4">Chirper</h1>
            <p class="text-xl text-white/90">Share your thoughts with the world</p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex justify-center gap-4 mb-16 fade-in-up stagger-1">
            <a href="{{ route('register') }}" 
               class="px-8 py-4 bg-white text-purple-700 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-lg">
                Get Started
            </a>
            <a href="{{ route('login') }}" 
               class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold text-lg hover:bg-white hover:text-purple-700 transition-all duration-300 hover:scale-105">
                Sign In
            </a>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="feature-card p-6 rounded-2xl text-white fade-in-up stagger-2">
                <div class="text-4xl mb-4">💬</div>
                <h3 class="text-xl font-semibold mb-2">Share Thoughts</h3>
                <p class="text-white/80">Express yourself with quick chirps up to 255 characters</p>
            </div>
            
            <div class="feature-card p-6 rounded-2xl text-white fade-in-up stagger-3">
                <div class="text-4xl mb-4">❤️</div>
                <h3 class="text-xl font-semibold mb-2">Engage & Like</h3>
                <p class="text-white/80">Show appreciation for chirps you love with likes</p>
            </div>
            
            <div class="feature-card p-6 rounded-2xl text-white fade-in-up stagger-4">
                <div class="text-4xl mb-4">👤</div>
                <h3 class="text-xl font-semibold mb-2">Build Profile</h3>
                <p class="text-white/80">Customize your profile and connect with others</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-3 gap-4 text-center text-white fade-in-up stagger-4">
            <div class="feature-card p-4 rounded-xl">
                <div class="text-3xl font-bold">1K+</div>
                <div class="text-white/80">Active Users</div>
            </div>
            <div class="feature-card p-4 rounded-xl">
                <div class="text-3xl font-bold">10K+</div>
                <div class="text-white/80">Chirps Shared</div>
            </div>
            <div class="feature-card p-4 rounded-xl">
                <div class="text-3xl font-bold">50K+</div>
                <div class="text-white/80">Likes Given</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-white/60 fade-in-up stagger-4">
            <p>© 2025 Chirper. Built with Laravel & ❤️</p>
        </div>
    </div>
</body>
</html>
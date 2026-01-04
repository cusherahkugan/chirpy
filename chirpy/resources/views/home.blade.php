<x-layout>
    <x-slot:title>Home Feed</x-slot:title>

    <div class="max-w-3xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2 gradient-text">Latest Chirps</h1>
            <p class="text-gray-600">See what's happening in your world</p>
        </div>

        <!-- Chirp Form -->
        @auth
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 animate-slide-up">
                <form method="POST" action="/chirps">
                    @csrf
                    <div class="flex gap-4">
                        <img src="{{ auth()->user()->avatar_url }}" 
                             alt="{{ auth()->user()->name }}" 
                             class="w-12 h-12 rounded-full">
                        
                        <div class="flex-1">
                            <textarea
                                name="message"
                                placeholder="What's on your mind?"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('message') border-red-500 @enderror"
                                rows="3"
                                maxlength="255"
                                required
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="flex justify-between items-center mt-3">
                                <span class="text-sm text-gray-500">
                                    <span class="font-medium">Tip:</span> Keep it short and sweet (max 255 chars)
                                </span>
                                <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg">
                                    Chirp
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-md p-8 mb-8 text-white text-center">
                <h2 class="text-2xl font-bold mb-3">Join Chirper Today!</h2>
                <p class="mb-6">Sign up to start sharing your thoughts with the world</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-purple-600 rounded-full font-semibold hover:bg-gray-100 transition-all">
                        Sign Up
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-purple-600 transition-all">
                        Sign In
                    </a>
                </div>
            </div>
        @endauth

        <!-- Feed -->
        <div class="space-y-4">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <div class="text-6xl mb-4">🐦</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No chirps yet</h3>
                    <p class="text-gray-600">Be the first to share something!</p>
                </div>
            @endforelse
        </div>

        <!-- Load More -->
        @if($chirps->count() >= 50)
            <div class="mt-8 text-center">
                <button class="px-6 py-3 text-purple-600 font-semibold hover:text-purple-700 transition-colors">
                    Load More Chirps
                </button>
            </div>
        @endif
    </div>
</x-layout>
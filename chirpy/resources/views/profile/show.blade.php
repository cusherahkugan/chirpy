
<x-layout>
    <x-slot:title>{{ $user->name }}'s Profile</x-slot:title>

    <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 animate-slide-up">
            <!-- Cover Image -->
            <div class="h-48 bg-gradient-to-r from-purple-600 to-pink-600"></div>
            
            <!-- Profile Info -->
            <div class="px-6 pb-6">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16">
                    <!-- Avatar -->
                    <div class="flex items-end gap-4">
                        <img src="{{ $user->avatar_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <div class="mb-2">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            @if($user->username)
                                <p class="text-gray-600">@{{ $user->username }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Button -->
                    @if(auth()->check() && auth()->id() === $user->id)
                        <a href="{{ route('profile.edit') }}" 
                           class="mt-4 md:mt-0 px-6 py-2 border-2 border-purple-600 text-purple-600 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition-all duration-300">
                            Edit Profile
                        </a>
                    @endif
                </div>

                <!-- Bio -->
                @if($user->bio)
                    <p class="mt-4 text-gray-700">{{ $user->bio }}</p>
                @endif

                <!-- Meta Info -->
                <div class="flex flex-wrap gap-4 mt-4 text-gray-600 text-sm">
                    @if($user->location)
                        <div class="flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $user->location }}</span>
                        </div>
                    @endif

                    @if($user->website)
                        <a href="{{ $user->website }}" target="_blank" class="flex items-center gap-1 hover:text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <span>{{ Str::limit($user->website, 30) }}</span>
                        </a>
                    @endif

                    <div class="flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Joined {{ $user->created_at->format('F Y') }}</span>
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex gap-6 mt-6 pt-6 border-t">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $user->chirps()->count() }}</div>
                        <div class="text-gray-600 text-sm">Chirps</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $user->likes()->count() }}</div>
                        <div class="text-gray-600 text-sm">Likes Given</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">
                            {{ $user->chirps()->withCount('likes')->get()->sum('likes_count') }}
                        </div>
                        <div class="text-gray-600 text-sm">Likes Received</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User's Chirps -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Chirps</h2>
            
            <div class="space-y-4">
                @forelse($chirps as $chirp)
                    <x-chirp :chirp="$chirp" />
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-gray-600">No chirps yet</p>
                        @if(auth()->check() && auth()->id() === $user->id)
                            <a href="/" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700">
                                Post Your First Chirp
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $chirps->links() }}
            </div>
        </div>
    </div>
</x-layout>
@props(['chirp'])

<div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 p-6 card-hover animate-slide-up">
    <div class="flex gap-4">
        <!-- Avatar -->
        <a href="{{ route('profile.show', $chirp->user) }}">
            <img src="{{ $chirp->user->avatar_url }}" 
                 alt="{{ $chirp->user->name }}" 
                 class="w-12 h-12 rounded-full hover:ring-2 ring-purple-500 transition-all">
        </a>

        <!-- Content -->
        <div class="flex-1 min-w-0">
            <!-- Header -->
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('profile.show', $chirp->user) }}" class="font-semibold text-gray-900 hover:text-purple-600 transition-colors">
                        {{ $chirp->user->name }}
                    </a>
                    @if($chirp->user->username)
                        <span class="text-gray-500 text-sm">@{{ $chirp->user->username }}</span>
                    @endif
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-500 text-sm">{{ $chirp->created_at->diffForHumans() }}</span>
                    @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                        <span class="text-gray-400 text-sm italic">(edited)</span>
                    @endif
                </div>

                <!-- Action Menu -->
                @can('update', $chirp)
                    <div class="flex gap-2">
                        <a href="{{ route('chirps.edit', $chirp) }}" 
                           class="text-gray-500 hover:text-purple-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form method="POST" action="/chirps/{{ $chirp->id }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this chirp?')"
                                    class="text-gray-500 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Message -->
            <p class="text-gray-800 mb-3 whitespace-pre-wrap">{{ $chirp->message }}</p>

            <!-- Actions Bar -->
            <div class="flex items-center gap-6 text-gray-500 text-sm">
                <!-- Like Button -->
                @auth
                    <form method="POST" action="{{ route('chirps.like', $chirp) }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 hover:text-pink-600 transition-all like-btn {{ auth()->user()->hasLiked($chirp) ? 'liked text-pink-600' : '' }}">
                            <svg class="w-5 h-5" fill="{{ auth()->user()->hasLiked($chirp) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="font-medium">{{ $chirp->likes_count ?? $chirp->likesCount() }}</span>
                        </button>
                    </form>
                @else
                    <div class="flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="font-medium">{{ $chirp->likes_count ?? $chirp->likesCount() }}</span>
                    </div>
                @endauth

                <!-- Comment Button -->
                <a href="{{ route('chirps.show', $chirp) }}" class="flex items-center gap-1 hover:text-purple-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="font-medium">{{ $chirp->comments_count ?? $chirp->commentsCount() }}</span>
                </a>

                <!-- Share Button -->
                <button class="flex items-center gap-1 hover:text-purple-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
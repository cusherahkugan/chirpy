<x-layout>
    <x-slot:title>Chirp Details</x-slot:title>

    <div class="max-w-3xl mx-auto">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Feed
        </a>

        <!-- Main Chirp -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 animate-slide-up">
            <div class="flex gap-4">
                <a href="{{ route('profile.show', $chirp->user) }}">
                    <img src="{{ $chirp->user->avatar_url }}" 
                         alt="{{ $chirp->user->name }}" 
                         class="w-14 h-14 rounded-full hover:ring-2 ring-purple-500 transition-all">
                </a>

                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <a href="{{ route('profile.show', $chirp->user) }}" class="font-bold text-lg text-gray-900 hover:text-purple-600">
                                {{ $chirp->user->name }}
                            </a>
                            @if($chirp->user->username)
                                <span class="text-gray-500 ml-2">@{{ $chirp->user->username }}</span>
                            @endif
                            <div class="text-gray-500 text-sm mt-1">
                                {{ $chirp->created_at->format('M j, Y \a\t g:i A') }}
                            </div>
                        </div>

                        @can('update', $chirp)
                            <div class="flex gap-2">
                                <a href="{{ route('chirps.edit', $chirp) }}" class="text-gray-500 hover:text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="/chirps/{{ $chirp->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this chirp?')" class="text-gray-500 hover:text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <p class="text-gray-800 text-lg mb-4 whitespace-pre-wrap">{{ $chirp->message }}</p>

                    <div class="flex items-center gap-6 text-gray-600 border-t pt-3">
                        @auth
                            <form method="POST" action="{{ route('chirps.like', $chirp) }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 hover:text-pink-600 transition-all like-btn {{ auth()->user()->hasLiked($chirp) ? 'liked text-pink-600' : '' }}">
                                    <svg class="w-6 h-6" fill="{{ auth()->user()->hasLiked($chirp) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span class="font-semibold">{{ $chirp->likes_count }} {{ Str::plural('like', $chirp->likes_count) }}</span>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="font-semibold">{{ $chirp->likes_count }} {{ Str::plural('like', $chirp->likes_count) }}</span>
                            </div>
                        @endauth

                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span class="font-semibold">{{ $chirp->comments_count }} {{ Str::plural('comment', $chirp->comments_count) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Form -->
        @auth
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-semibold text-lg mb-4">Add a Comment</h3>
                <form method="POST" action="/chirps/{{ $chirp->id }}/comments">
                    @csrf
                    <textarea name="content" 
                              rows="3" 
                              placeholder="Share your thoughts..." 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('content') border-red-500 @enderror"
                              required></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-end mt-3">
                        <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg">
                            Comment
                        </button>
                    </div>
                </form>
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-4">
            <h3 class="font-bold text-xl mb-4">Comments ({{ $chirp->comments->count() }})</h3>
            
            @forelse($chirp->comments as $comment)
                <div class="bg-white rounded-lg shadow-sm p-4 animate-slide-up">
                    <div class="flex gap-3">
                        <a href="{{ route('profile.show', $comment->user) }}">
                            <img src="{{ $comment->user->avatar_url }}" 
                                 alt="{{ $comment->user->name }}" 
                                 class="w-10 h-10 rounded-full">
                        </a>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <div>
                                    <a href="{{ route('profile.show', $comment->user) }}" class="font-semibold text-gray-900 hover:text-purple-600">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                @if($comment->user_id === auth()->id())
                                    <form method="POST" action="/comments/{{ $comment->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this comment?')" class="text-gray-400 hover:text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p>No comments yet. Be the first to comment!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
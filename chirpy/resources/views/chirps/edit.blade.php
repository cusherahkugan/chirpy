<x-layout>
    <x-slot:title>Edit Chirp</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <a href="/" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Cancel
        </a>

        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Chirp</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="/chirps/{{ $chirp->id }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Message
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        maxlength="255"
                        placeholder="What's on your mind?"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('message') border-red-500 @enderror"
                        required
                    >{{ old('message', $chirp->message) }}</textarea>
                    
                    <div class="flex justify-between items-center mt-2">
                        @error('message')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @else
                            <span class="text-gray-500 text-sm">Maximum 255 characters</span>
                        @enderror
                        <span class="text-gray-500 text-sm" id="char-count">
                            {{ strlen(old('message', $chirp->message)) }}/255
                        </span>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="/" class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg">
                        Update Chirp
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('message');
        const charCount = document.getElementById('char-count');
        
        textarea.addEventListener('input', function() {
            charCount.textContent = `${this.value.length}/255`;
        });
    </script>
</x-layout>
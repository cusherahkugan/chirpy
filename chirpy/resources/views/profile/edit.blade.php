
<x-layout>
    <x-slot:title>Edit Profile</x-slot:title>

    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Profile</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Profile Picture</label>
                    <div class="flex items-center gap-6">
                        <img id="avatar-preview" 
                             src="{{ auth()->user()->avatar_url }}" 
                             alt="Avatar Preview" 
                             class="w-24 h-24 rounded-full border-2 border-gray-200">
                        <div>
                            <label for="avatar" class="cursor-pointer px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors inline-block">
                                Choose Image
                            </label>
                            <input type="file" 
                                   id="avatar" 
                                   name="avatar" 
                                   accept="image/*" 
                                   class="hidden"
                                   onchange="previewAvatar(event)">
                            <p class="text-sm text-gray-500 mt-2">JPG, PNG or GIF. Max 2MB.</p>
                            @error('avatar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Name *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>
                    <div class="flex items-center">
                        <span class="px-3 py-3 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-600">@</span>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               value="{{ old('username', $user->username) }}"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('username') border-red-500 @enderror"
                               placeholder="yourhandle">
                    </div>
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                        Bio
                    </label>
                    <textarea id="bio" 
                              name="bio" 
                              rows="4" 
                              maxlength="500"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none @error('bio') border-red-500 @enderror"
                              placeholder="Tell us about yourself">{{ old('bio', $user->bio) }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Maximum 500 characters</p>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           value="{{ old('location', $user->location) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('location') border-red-500 @enderror"
                           placeholder="New York, USA">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Website -->
                <div class="mb-6">
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                        Website
                    </label>
                    <input type="url" 
                           id="website" 
                           name="website" 
                           value="{{ old('website', $user->website) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('website') border-red-500 @enderror"
                           placeholder="https://yourwebsite.com">
                    @error('website')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('profile.show', $user) }}" 
                       class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layout>
<!-- ========================================
     FILE: resources/views/auth/register.blade.php (REPLACE ENTIRE FILE)
     ======================================== -->
<x-layout>
    <x-slot:title>Create Account</x-slot:title>

    <div class="min-h-[calc(100vh-20rem)] flex items-center justify-center py-8">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="text-5xl mb-4">🐦</div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Join Chirper</h1>
                    <p class="text-gray-600">Create your account and start chirping</p>
                </div>

                <!-- Form -->
                <form method="POST" action="/register" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="your@email.com"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @else
                            <p class="text-gray-500 text-xs mt-1">Must be at least 8 characters</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                               required>
                    </div>

                    <!-- Terms (Optional) -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox"
                                   id="terms"
                                   class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                                   required>
                        </div>
                        <label for="terms" class="ml-2 text-sm text-gray-700">
                            I agree to the 
                            <a href="#" class="text-purple-600 hover:text-purple-700">Terms of Service</a> 
                            and 
                            <a href="#" class="text-purple-600 hover:text-purple-700">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">OR</span>
                    </div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-600">
                    Already have an account?
                    <a href="/login" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">
                        Sign in instead
                    </a>
                </p>
            </div>

            <!-- Back to Landing -->
            <div class="text-center mt-6">
                <a href="/welcome" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                    ← Back to home
                </a>
            </div>
        </div>
    </div>
</x-layout>
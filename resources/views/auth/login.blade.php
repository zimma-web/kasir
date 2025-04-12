<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/bg-kasir.png') }}');">
    <div class="w-full max-w-md p-8 bg-[#FFF8E7] rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] animate__animated animate__fadeIn relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23FFB84C\" fill-opacity=\"0.1\" fill-rule=\"evenodd\"%3E%3Ccircle cx=\"3\" cy=\"3\" r=\"3\"/%3E%3Ccircle cx=\"13\" cy=\"13\" r=\"3\"/%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        <!-- Logo Section -->
        <div class="flex justify-center mb-8 relative">
            <img src="{{ asset('assets/logo_kasir.png') }}" alt="Logo" class="w-32 h-auto animate__animated animate__bounceIn animate__delay-1s hover:animate__rubberBand">
        </div>

        <h2 class="text-3xl font-bold text-center text-[#FF6B6B] mb-4">Welcome Back!</h2>
        <p class="text-center text-[#666666] mb-8 text-lg">Please sign in to your account</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-[#4CAF50] bg-[#E8F5E9] p-3 rounded-2xl">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
            @csrf
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-[#666666]">Email</label>
                <div class="relative">
                    <input type="email" 
                           name="email" 
                           required 
                           class="w-full px-5 py-4 bg-white border-2 border-[#FFD93D] rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#FFD93D] focus:border-[#FFD93D] transition-all duration-200 text-lg @error('email') border-red-400 @enderror"
                           value="{{ old('email') }}"
                           placeholder="Enter your email">
                    @error('email')
                        <p class="mt-2 text-sm text-red-400 bg-red-50 p-2 rounded-xl">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-lg font-semibold text-[#666666]">Password</label>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="password"
                           required 
                           class="w-full px-5 py-4 bg-white border-2 border-[#FFD93D] rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#FFD93D] focus:border-[#FFD93D] transition-all duration-200 text-lg @error('password') border-red-400 @enderror"
                           placeholder="Enter your password">
                    <button type="button" 
                            onclick="togglePassword()"
                            class="absolute right-5 top-1/2 transform -translate-y-1/2 text-[#FFB84C] hover:text-[#FF6B6B] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" id="eyeSlashIcon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400 bg-red-50 p-2 rounded-xl">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" 
                    class="w-full px-6 py-4 mt-8 text-white text-lg font-bold bg-gradient-to-r from-[#FF6B6B] to-[#FFB84C] rounded-2xl hover:from-[#FF8787] hover:to-[#FFD93D] focus:outline-none focus:ring-4 focus:ring-[#FFB84C] focus:ring-opacity-50 transition-all duration-200 flex items-center justify-center transform hover:scale-105"
                    id="loginButton">
                <span>Sign In</span>
                <svg id="loadingIcon" class="hidden animate-spin ml-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        $(document).ready(function() {
            // Add loading state to form submission
            $('#loginForm').on('submit', function() {
                $('#loginButton').prop('disabled', true);
                $('#loadingIcon').removeClass('hidden');
            });

            // Add animation to form inputs
            $('input').on('focus', function() {
                $(this).parent().addClass('transform scale-105');
            }).on('blur', function() {
                $(this).parent().removeClass('transform scale-105');
            });
        });
    </script>
</body>
</html>
